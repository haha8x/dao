<?php

namespace Botble\Dao\Tables;

use Auth;
use Botble\Catalog\Repositories\Interfaces\CatalogBranchInterface;
use Botble\Catalog\Repositories\Interfaces\CatalogPositionInterface;
use Botble\Catalog\Repositories\Interfaces\CatalogZoneInterface;
use Botble\Dao\Enums\RequestStatusEnum;
use Botble\Dao\Repositories\Interfaces\DaoRequestNewInterface;
use Botble\Dao\Abstracts\ScrollTableAbstract;
use Illuminate\Contracts\Routing\UrlGenerator;
use Yajra\DataTables\DataTables;
use Html;

class DaoRequestNewTable extends ScrollTableAbstract
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
     * DaoRequestNewTable constructor.
     * @param DataTables $table
     * @param UrlGenerator $urlDevTool
     * @param DaoRequestNewInterface $daoRequestNewRepository
     */
    public function __construct(
        DataTables $table,
        UrlGenerator $urlDevTool,
        DaoRequestNewInterface $daoRequestNewRepository,
        CatalogPositionInterface $catalogPositionRepository,
        CatalogBranchInterface $catalogBranchRepository,
        CatalogZoneInterface $catalogZoneRepository
    ) {
        $this->repository = $daoRequestNewRepository;
        $this->catalogPositionRepository = $catalogPositionRepository;
        $this->catalogBranchRepository = $catalogBranchRepository;
        $this->catalogZoneRepository = $catalogZoneRepository;
        $this->setOption('id', 'table-plugins-request-new');
        parent::__construct($table, $urlDevTool);

        if (!Auth::user()->hasAnyPermission(['request-new.edit', 'request-new.destroy'])) {
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
                return $item->zone? $item->zone->name : null;
            })
            ->editColumn('branch_id', function ($item) {
                return $item->branch? $item->branch->name: null;
            })
            ->editColumn('position_id', function ($item) {
                return $item->position? $item->position->name: null;
            })
            ->editColumn('status_dao', function ($item) {
                return '60';
            })
            ->editColumn('id', function ($item) {
                return ('DAO' . $item->id);
            })
            ->editColumn('created_at', function ($item) {
                return date_from_database($item->created_at, config('core.base.general.date_format.date'));
            })
            ->editColumn('status', function ($item) {
                return $item->status? $item->status->toHtml(): null;
            });

        return apply_filters(BASE_FILTER_GET_LIST_DATA, $data, $this->repository->getModel())
            ->addColumn('action', function ($item) {
                return view('plugins/dao::request.new.actions', compact('item'))->render();
            })
            ->addColumn('operations', function ($item) {
                return table_actions('request-new.edit', 'request-new.destroy', $item);
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
            'request_news.id',
            'request_news.zone_id',
            'request_news.branch_id',
            'request_news.staff_id',
            'request_news.staff_name',
            'request_news.position_id',
            'request_news.cif',
            'request_news.email',
            'request_news.cmnd',
            'request_news.phone',
            'request_news.status',
            'request_news.created_at',
        ]);

        if (!Auth::user()->isSuperUser() || !Auth::user()->hasPermission('request-new.all')) {
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
            'zone_id' => [
                'name'  => 'request_news.zone_id',
                'title' => __('Vùng'),
                'class' => 'text-left',
            ],
            'branch_id' => [
                'name'  => 'request_news.branch_id',
                'title' => __('Chi nhánh'),
                'class' => 'text-left',
            ],
            'id' => [
                'name'  => 'request_news.id',
                'title' => __('Mã YC'),
                'class' => 'text-left',
            ],
            'staff_name' => [
                'name'  => 'request_news.staff_name',
                'title' => __('Nhân viên'),
                'class' => 'text-left',
            ],
            'position_id' => [
                'name'  => 'request_news.position_id',
                'title' => __('Vị trí'),
                'class' => 'text-left',
            ],
            'status_dao' => [
                'name'  => 'request_news.status_dao',
                'title' => __('Trạng thái DAO'),
                'class' => 'text-left',
            ],
            'email' => [
                'name'  => 'request_news.email',
                'title' => __('Email'),
                'class' => 'text-left',
            ],
            'cif' => [
                'name'  => 'request_news.cif',
                'title' => __('CIF'),
                'class' => 'text-left',
            ],
            'cmnd' => [
                'name'  => 'request_news.cmnd',
                'title' => __('CMND'),
                'class' => 'text-left',
            ],
            'phone' => [
                'name'  => 'request_news.phone',
                'title' => __('Điện thoại'),
                'class' => 'text-left',
            ],
            'status' => [
                'name'  => 'request_news.status',
                'title' => __('Trạng thái xử lý'),
                'class' => 'text-left',
            ],
            'created_at' => [
                'name'  => 'request_news.created_at',
                'title' => trans('core/base::tables.created_at'),
            ],
            'action' => [
                'name'  => 'request_news.action',
                'title' => __('Xem'),
            ],
        ];
    }

    /**
     * @return array
     */
    public function getBulkChanges(): array
    {
        return [
            'request_news.status' => [
                'title'    => trans('core/base::tables.status'),
                'type'     => 'select',
                'choices'  => RequestStatusEnum::labels(),
                'validate' => 'required|in:' . implode(',', RequestStatusEnum::values()),
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
