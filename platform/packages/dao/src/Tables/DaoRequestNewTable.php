<?php

namespace Botble\Dao\Tables;

use Auth;
use Botble\Catalog\Repositories\Interfaces\CatalogBranchInterface;
use Botble\Catalog\Repositories\Interfaces\CatalogPositionInterface;
use Botble\Catalog\Repositories\Interfaces\CatalogZoneInterface;
use Botble\Dao\Enums\DaoRequestStatusEnum;
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
        $this->setOption('id', 'table-plugins-dao-request-new');
        parent::__construct($table, $urlDevTool);

        if (!Auth::user()->hasAnyPermission(['dao-request-new.edit', 'dao-request-new.destroy'])) {
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
                return $item->zone->name;
            })
            ->editColumn('branch_id', function ($item) {
                return $item->branch->name;
            })
            ->editColumn('position_id', function ($item) {
                return $item->position->name;
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
                return $item->status->toHtml();
            });

        return apply_filters(BASE_FILTER_GET_LIST_DATA, $data, $this->repository->getModel())
            ->addColumn('operations', function ($item) {
                return view('packages/dao::request-new.actions', compact('item'))->render();
            })
            // ->addColumn('operations', function ($item) {
            //     $action = null;
            //     // if (Auth::user()->isSuperUser()) {
            //     if ($item->status != 'gdcn_approve') {
            //         $action = Html::link(
            //             route('dao-request-new.approve', $item->id),
            //             __('Duyệt'),
            //             ['class' => 'btn btn-info']
            //         )->toHtml();
            //     }

            //     $action = Html::link(
            //         'javascript:;',
            //         __('i'),
            //         [
            //             "class" => "btn btn-info",
            //             "data-fancybox" => "",
            //             "data-type" => "ajax",
            //             "data-src" => "{{ route('dao-request-new.edit', $item->id) }}",
            //         ]
            //     )->toHtml();

            //     if ($item->super_user) {
            //         $action = Html::link(
            //             route('users.remove-super', $item->id),
            //             __('Remove super'),
            //             ['class' => 'btn btn-danger']
            //         )->toHtml();
            //     }
            // }
            //     return apply_filters(
            //         ACL_FILTER_USER_TABLE_ACTIONS,
            //         $action,
            //         $item
            //     );
            // })
            // ->addColumn('operations', function ($item) {
            //     return table_actions('dao-request-new.edit', 'dao-request-new.destroy', $item);
            // })
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
            'dao_request_news.id',
            'dao_request_news.zone_id',
            'dao_request_news.branch_id',
            'dao_request_news.staff_id',
            'dao_request_news.staff_name',
            'dao_request_news.position_id',
            'dao_request_news.cif',
            'dao_request_news.email',
            'dao_request_news.cmnd',
            'dao_request_news.phone',
            'dao_request_news.status',
            'dao_request_news.created_at',
            'dao_request_news.updated_by',
        ]);

        if (!Auth::user()->isSuperUser()) {
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
                'name'  => 'dao_request_news.zone_id',
                'title' => __('Vùng'),
                'class' => 'text-left',
            ],
            'branch_id' => [
                'name'  => 'dao_request_news.branch_id',
                'title' => __('Chi nhánh'),
                'class' => 'text-left',
            ],
            'id' => [
                'name'  => 'dao_request_news.id',
                'title' => __('Mã YC'),
                'class' => 'text-left',
            ],
            'staff_name' => [
                'name'  => 'dao_request_news.staff_name',
                'title' => __('Nhân viên'),
                'class' => 'text-left',
            ],
            'position_id' => [
                'name'  => 'dao_request_news.position_id',
                'title' => __('Vị trí'),
                'class' => 'text-left',
            ],
            'status_dao' => [
                'name'  => 'dao_request_news.status_dao',
                'title' => __('Trạng thái DAO'),
                'class' => 'text-left',
            ],
            'email' => [
                'name'  => 'dao_request_news.email',
                'title' => __('Email'),
                'class' => 'text-left',
            ],
            'cif' => [
                'name'  => 'dao_request_news.cif',
                'title' => __('CIF'),
                'class' => 'text-left',
            ],
            'cmnd' => [
                'name'  => 'dao_request_news.cmnd',
                'title' => __('CMND'),
                'class' => 'text-left',
            ],
            'phone' => [
                'name'  => 'dao_request_news.phone',
                'title' => __('Điện thoại'),
                'class' => 'text-left',
            ],
            'status' => [
                'name'  => 'dao_request_news.status',
                'title' => __('Trạng thái xử lý'),
                'class' => 'text-left',
            ],
            'created_at' => [
                'name'  => 'dao_request_news.created_at',
                'title' => trans('core/base::tables.created_at'),
            ],
        ];
    }

    /**
     * @return array
     */
    public function getBulkChanges(): array
    {
        return [
            'dao_request_news.status' => [
                'title'    => trans('core/base::tables.status'),
                'type'     => 'select',
                'choices'  => DaoRequestStatusEnum::labels(),
                'validate' => 'required|in:' . implode(',', DaoRequestStatusEnum::values()),
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
                'class'      => 'text-right',
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
        return ['excel', 'reload'];
    }

    /**
     * @return array
     */
    public function getPositions()
    {
        return $this->catalogPositionRepository->pluck('catalog_positions.name', 'catalog_positions.id');
    }

    /**
     * @return array
     */
    public function getBranchs()
    {
        return $this->catalogBranchRepository->pluck('catalog_branches.name', 'catalog_branches.id');
    }

    /**
     * @return array
     */
    public function getZones()
    {
        return $this->catalogZoneRepository->pluck('catalog_zones.name', 'catalog_zones.id');
    }
}
