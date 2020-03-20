<?php

namespace Botble\Dao\Tables;

use Auth;
use Botble\Catalog\Repositories\Interfaces\CatalogBranchInterface;
use Botble\Catalog\Repositories\Interfaces\CatalogPositionInterface;
use Botble\Catalog\Repositories\Interfaces\CatalogZoneInterface;
use Botble\Dao\Repositories\Interfaces\DaoInterface;
use Botble\Dao\Abstracts\ScrollTableAbstract;
use Illuminate\Contracts\Routing\UrlGenerator;
use Yajra\DataTables\DataTables;
use Html;


class DaoTable extends ScrollTableAbstract
{

    /**
     * @var bool
     */
    protected $hasActions = false;

    /**
     * @var bool
     */
    protected $hasFilter = false;

    /**
     * DaoTable constructor.
     * @param DataTables $table
     * @param UrlGenerator $urlDevTool
     * @param DaoInterface $daoRepository
     */
    public function __construct(
        DataTables $table,
        UrlGenerator $urlDevTool,
        DaoInterface $daoRepository,
        CatalogPositionInterface $catalogPositionRepository,
        CatalogBranchInterface $catalogBranchRepository,
        CatalogZoneInterface $catalogZoneRepository
    ) {
        $this->repository = $daoRepository;
        $this->catalogPositionRepository = $catalogPositionRepository;
        $this->catalogBranchRepository = $catalogBranchRepository;
        $this->catalogZoneRepository = $catalogZoneRepository;
        $this->setOption('id', 'table-plugins-dao');
        parent::__construct($table, $urlDevTool);

        if (!Auth::user()->hasAnyPermission(['dao.edit', 'dao.destroy'])) {
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
            ->editColumn('created_at', function ($item) {
                return date_from_database($item->created_at, config('core.base.general.date_format.date'));
            });

        return apply_filters(BASE_FILTER_GET_LIST_DATA, $data, $this->repository->getModel())
            ->addColumn('operations', function ($item) {
                return view('packages/dao::index.actions', compact('item'))->render();
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
            'daos.id',
            'daos.dao',
            'daos.zone_id',
            'daos.branch_id',
            'daos.staff_id',
            'daos.name',
            'daos.position_id',
            'daos.cif',
            'daos.email',
            'daos.cmnd',
            'daos.phone',
            'daos.status',
            'daos.created_at',
            'daos.updated_by',
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
                'name'  => 'daos.zone_id',
                'title' => __('Vùng'),
                'class' => 'text-left',
            ],
            'branch_id' => [
                'name'  => 'daos.branch_id',
                'title' => __('Chi nhánh'),
                'class' => 'text-left',
            ],
            'dao' => [
                'name'  => 'daos.dao',
                'title' => __('DAO'),
                'class' => 'text-left',
            ],
            'name' => [
                'name'  => 'daos.name',
                'title' => __('Nhân viên'),
                'class' => 'text-left',
            ],
            'email' => [
                'name'  => 'daos.email',
                'title' => __('Email'),
                'class' => 'text-left',
            ],
            'cmnd' => [
                'name'  => 'daos.cmnd',
                'title' => __('CMND'),
                'class' => 'text-left',
            ],
            'phone' => [
                'name'  => 'daos.phone',
                'title' => __('Điện thoại'),
                'class' => 'text-left',
            ],
            'cif' => [
                'name'  => 'daos.cif',
                'title' => __('CIF'),
                'class' => 'text-left',
            ],
            'status' => [
                'name'  => 'daos.status',
                'title' => __('Trạng thái'),
                'class' => 'text-left',
            ],
            'created_at' => [
                'name'  => 'daos.created_at',
                'title' => trans('core/base::tables.created_at'),
                'width' => '100px',
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
