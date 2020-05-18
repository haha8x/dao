<?php

namespace Botble\Dao\Tables;

use Auth;
use Botble\Dao\Enums\RequestStatusEnum;
use Botble\Dao\Repositories\Interfaces\DaoRequestTransferInterface;
use Botble\Table\Abstracts\TableAbstract;
use Illuminate\Contracts\Routing\UrlGenerator;
use Yajra\DataTables\DataTables;
use Botble\Dao\Models\RequestTransfer;
use Botble\Catalog\Repositories\Interfaces\CatalogBranchInterface;
use Botble\Catalog\Repositories\Interfaces\CatalogPositionInterface;
use Botble\Catalog\Repositories\Interfaces\CatalogZoneInterface;


class DaoRequestTransferTable extends TableAbstract
{

    /**
     * @var bool
     */
    protected $hasActions = true;

    /**
     * @var bool
     */
    protected $hasFilter = true;

    protected $catalogPositionRepository;
    protected $catalogBranchRepository;
    protected $catalogZoneRepository;

    /**
     * DaoRequestTransferTable constructor.
     * @param DataTables $table
     * @param UrlGenerator $urlDevTool
     * @param DaoRequestTransferInterface $DaoRequestTransferRepository
     */
    public function __construct(
        DataTables $table,
        UrlGenerator $urlDevTool,
        DaoRequestTransferInterface $DaoRequestTransferRepository,
        CatalogPositionInterface $catalogPositionRepository,
        CatalogBranchInterface $catalogBranchRepository,
        CatalogZoneInterface $catalogZoneRepository
    ) {
        $this->repository = $DaoRequestTransferRepository;
        $this->catalogPositionRepository = $catalogPositionRepository;
        $this->catalogBranchRepository = $catalogBranchRepository;
        $this->catalogZoneRepository = $catalogZoneRepository;
        $this->setOption('id', 'table-plugins-request-transfer');
        parent::__construct($table, $urlDevTool);

        if (!Auth::user()->hasAnyPermission(['request-transfer.edit', 'request-transfer.destroy'])) {
            $this->hasOperations = false;
            $this->hasActions = false;
        }
    }

    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     * @since 2.1
     */
    public function ajax()
    {
        $data = $this->table
            ->eloquent($this->query())
            ->editColumn('checkbox', function ($item) {
                return table_checkbox($item->id);
            })
            // ->editColumn('zone_id', function ($item) {
            //     return $item->zone ? $item->zone->name : null;
            // })
            ->editColumn('branch_code', function ($item) {
                return $item->branch ? $item->branch->code : null;
            })
            ->editColumn('id', function ($item) {
                return ('DAO' . $item->id);
            })
            ->editColumn('created_at', function ($item) {
                return date_from_database($item->created_at, config('core.base.general.date_format.date'));
            })
            ->editColumn('type', function ($item) {
                return $item->type ? $item->type->toHtml() : null;
            })
            ->editColumn('status', function ($item) {
                return $item->status ? $item->status->toHtml() : null;
            });

        return apply_filters(BASE_FILTER_GET_LIST_DATA, $data, $this->repository->getModel())
            ->addColumn('action', function ($item) {
                return view('plugins/dao::request.transfer.actions', compact('item'))->render();
            })
            ->addColumn('operations', function ($item) {
                return table_actions('request-transfer.edit', 'request-transfer.destroy', $item);
            })
            ->escapeColumns([])
            ->make(true);
    }

    /**
     * Get the query object to be processed by table.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     * @since 2.1
     */
    public function query()
    {
        $model = $this->repository->getModel();
        $query = $model->select([
            'request_transfers.id',
            'request_transfers.type',
            'request_transfers.branch_id',
            'request_transfers.zone_id',
            'request_transfers.staff_name',
            'request_transfers.email',
            'request_transfers.dao_old',
            'request_transfers.dao_transfer',
            'request_transfers.reason',
            'request_transfers.status',
            'request_transfers.created_at',
        ]);

        if (!Auth::user()->isSuperUser() || !Auth::user()->hasPermission('request-transfer.all')) {
            $query = $model->where('created_by', Auth::id());
        }

        return $this->applyScopes(apply_filters(BASE_FILTER_TABLE_QUERY, $query, $model));
    }

    /**
     * @return array
     * @since 2.1
     */
    public function columns()
    {
        return [
            // 'zone_id' => [
            //     'name'  => 'request_transfers.zone_id',
            //     'title' => __('Vùng'),
            //     'class' => 'text-left',
            // ],
            'branch_code' => [
                'name'  => 'request_transfers.branch_code',
                'title' => __('Mã chi nhánh'),
                'class' => 'text-left',
                'orderable'  => false,
            ],
            'id' => [
                'name'  => 'request_transfers.id',
                'title' => __('Mã YC'),
                'class' => 'text-left',
            ],
            // 'staff_name' => [
            //     'name'  => 'request_transfers.staff_name',
            //     'title' => __('Tên nhân viên'),
            //     'class' => 'text-left',
            // ],
            // 'email' => [
            //     'name'  => 'request_transfers.email',
            //     'title' => __('Email'),
            //     'class' => 'text-left',
            // ],
            'dao_old' => [
                'name'  => 'request_transfers.dao_old',
                'title' => __('DAO cũ'),
                'class' => 'text-left',
            ],
            'dao_transfer' => [
                'name'  => 'request_transfers.dao_transfer',
                'title' => __('DAO mới'),
                'class' => 'text-left',
            ],
            'reason' => [
                'name'  => 'request_transfers.reason',
                'title' => __('Lý do'),
                'class' => 'text-left',
            ],
            'status' => [
                'name'  => 'request_transfers.status',
                'title' => __('Trạng thái'),
                'class' => 'text-left',
            ],
            'type' => [
                'name'  => 'request_transfers.type',
                'title' => __('Yêu cầu'),
                'class' => 'text-left',
            ],
            'created_at' => [
                'name'  => 'request_transfers.created_at',
                'title' => trans('core/base::tables.created_at'),
            ],
            'action' => [
                'name'  => 'request_updates.action',
                'title' => __('Xem'),
            ],
        ];
    }

    /**
     * @return array
     * @since 2.1
     * @throws \Throwable
     */
    public function buttons()
    {
        $buttons = $this->addCreateButton(route('request-transfer.create'), 'request-transfer.create');

        $buttons['import-field-group'] = [
            'link' => '#',
            'text' => view('plugins/dao::_partials.import')->render(),
        ];

        return apply_filters(BASE_FILTER_TABLE_BUTTONS, $buttons, RequestTransfer::class);
    }

    /**
     * @return array
     */
    public function getBulkChanges(): array
    {
        return [
            'request_transfers.status' => [
                'title'    => trans('core/base::tables.status'),
                'type'     => 'select',
                'choices'  => RequestStatusEnum::labels(),
                'validate' => 'required|in:' . implode(',', RequestStatusEnum::values()),
            ],
            'request_transfers.created_at' => [
                'title'    => trans('core/base::tables.created_at'),
                'type'     => 'date',
                'validate' => 'required',
            ],
        ];
    }

    /**
     * @return array
     */
    public function getOperationsHeading()
    {
        return [
            'operations' => [
                'title'      => trans('core/base::tables.operations'),
                // 'width'      => '350px',
                'class'      => 'text-center',
                'orderable'  => false,
                'searchable' => false,
                'exportable' => false,
                'printable'  => false,
            ],
        ];
    }

    /**
     * @return array
     */
    public function getDefaultButtons(): array
    {
        return ['excel'];
    }
}
