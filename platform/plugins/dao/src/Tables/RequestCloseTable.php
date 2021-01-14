<?php

namespace Botble\Dao\Tables;

use Auth;
use Botble\Dao\Repositories\Interfaces\RequestCloseInterface;
use Botble\Dao\Abstracts\TableAbstract;
use Illuminate\Contracts\Routing\UrlGenerator;
use Yajra\DataTables\DataTables;
use Botble\Dao\Models\RequestClose;
use Botble\Dao\Enums\RequestStatusEnum;
use Botble\Catalog\Repositories\Interfaces\CatalogBranchInterface;
use Botble\Catalog\Repositories\Interfaces\CatalogPositionInterface;
use Botble\Catalog\Repositories\Interfaces\CatalogZoneInterface;

class RequestCloseTable extends TableAbstract
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
     * RequestCloseTable constructor.
     * @param DataTables $table
     * @param UrlGenerator $urlDevTool
     * @param RequestCloseInterface $RequestCloseRepository
     */
    public function __construct(
        DataTables $table,
        UrlGenerator $urlDevTool,
        RequestCloseInterface $RequestCloseRepository,
        CatalogPositionInterface $catalogPositionRepository,
        CatalogBranchInterface $catalogBranchRepository,
        CatalogZoneInterface $catalogZoneRepository
    ) {
        $this->repository = $RequestCloseRepository;
        $this->catalogPositionRepository = $catalogPositionRepository;
        $this->catalogBranchRepository = $catalogBranchRepository;
        $this->catalogZoneRepository = $catalogZoneRepository;
        $this->setOption('id', 'table-plugins-request-close');
        parent::__construct($table, $urlDevTool);

        if (!Auth::user()->hasAnyPermission(['request-close.edit', 'request-close.destroy'])) {
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
            ->editColumn('zone_id', function ($item) {
                return $item->zone ? $item->zone->name : null;
            })
            ->editColumn('branch_id', function ($item) {
                return $item->branch ? $item->branch->name : null;
            })
            ->editColumn('branch_code', function ($item) {
                return $item->branch ? $item->branch->code : null;
            })
            ->editColumn('id', function ($item) {
                return ('DAO' . $item->id);
            })
            ->editColumn('created_at', function ($item) {
                return date_from_database($item->created_at, config('core.base.general.date_format.date'));
            })
            ->editColumn('status', function ($item) {
                return $item->status ? $item->status->toHtml() : null;
            });

        return apply_filters(BASE_FILTER_GET_LIST_DATA, $data, $this->repository->getModel())
            ->addColumn('action', function ($item) {
                return view('plugins/dao::request.close.actions', compact('item'))->render();
            })
            ->addColumn('operations', function ($item) {
                return table_actions('request-close.edit', 'request-close.destroy', $item);
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
            'request_closes.id',
            'request_closes.dao',
            'request_closes.zone_id',
            'request_closes.branch_id',
            'request_closes.staff_id',
            'request_closes.staff_name',
            'request_closes.position_id',
            'request_closes.cif',
            'request_closes.email',
            'request_closes.cmnd',
            'request_closes.status',
            'request_closes.created_at',
        ]);

        if (!Auth::user()->isSuperUser()) {
            if (Auth::user()->getPosition()->first() ? Auth::user()->getPosition()->first()->code == 'GDCN' : null) {
                $query = $model->where('branch_id', Auth::user()->getBranch()->first() ? Auth::user()->getBranch()->first()->id : null);
            } else {
                $query = $model->where('created_by', Auth::id());
            }
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
            'zone_id' => [
                'name'  => 'request_closes.zone_id',
                'title' => __('Vùng'),
                'class' => 'text-left',
                'width' => '50px',
            ],
            'branch_id' => [
                'name'  => 'request_closes.branch_id',
                'title' => __('Tên chi nhánh'),
                'class' => 'text-left',
            ],
            'branch_code' => [
                'name'  => 'request_closes.branch_code',
                'title' => __('Mã chi nhánh'),
                'class' => 'text-left',
            ],
            'id' => [
                'name'  => 'request_closes.id',
                'title' => __('Mã YC'),
                'class' => 'text-left',
            ],
            'staff_name' => [
                'name'  => 'request_closes.staff_name',
                'title' => __('Tên nhân viên'),
                'class' => 'text-left',
            ],
            'dao' => [
                'name'  => 'request_closes.dao',
                'title' => __('DAO cần đóng'),
                'class' => 'text-left',
            ],
            'email' => [
                'name'  => 'request_closes.email',
                'title' => __('Email'),
                'class' => 'text-left',
            ],
            'status' => [
                'name'  => 'request_closes.status',
                'title' => __('Trạng thái'),
                'class' => 'text-left',
            ],
            'created_at' => [
                'name'  => 'request_closes.created_at',
                'title' => trans('core/base::tables.created_at'),
                'width' => '100px',
            ],
            'action' => [
                'name'  => 'request_closes.action',
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
        $buttons = $this->addCreateButton(route('request-close.create'), 'request-close.create');

        $buttons['import-field-group'] = [
            'link' => '#',
            'text' => view('plugins/dao::_partials.import')->render(),
        ];

        return apply_filters(BASE_FILTER_TABLE_BUTTONS, $buttons, RequestClose::class);
    }

    /**
     * @return array
     */
    public function getBulkChanges(): array
    {
        return [
            'request_closes.status' => [
                'title'    => trans('core/base::tables.status'),
                'type'     => 'select',
                'choices'  => RequestStatusEnum::labels(),
                'validate' => 'required|in:' . implode(',', RequestStatusEnum::values()),
            ],
            'request_closes.created_at' => [
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
