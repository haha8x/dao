<?php

namespace Botble\Catalog\Tables;

use Auth;
use Botble\Catalog\Repositories\Interfaces\CatalogBranchInterface;
use Botble\Catalog\Repositories\Interfaces\CatalogZoneInterface;
use Botble\Table\Abstracts\TableAbstract;
use Illuminate\Contracts\Routing\UrlGenerator;
use Yajra\DataTables\DataTables;
use Botble\Catalog\Models\CatalogBranch;

class CatalogBranchTable extends TableAbstract
{

    /**
     * @var bool
     */
    protected $hasActions = false;

    /**
     * @var bool
     */
    protected $hasFilter = true;

    /**
     * @var CatalogZoneInterface
     */
    protected $catalogZoneRepository;

    /**
     * CatalogBranchTable constructor.
     * @param DataTables $table
     * @param UrlGenerator $urlDevTool
     * @param CatalogBranchInterface $catalogBranchRepository
     */
    public function __construct(
        DataTables $table,
        UrlGenerator $urlDevTool,
        CatalogBranchInterface $catalogBranchRepository,
        CatalogZoneInterface $catalogZoneRepository
    ) {
        $this->repository = $catalogBranchRepository;
        $this->catalogZoneRepository = $catalogZoneRepository;
        $this->setOption('id', 'table-packages-catalog-branch');
        parent::__construct($table, $urlDevTool);

        if (!Auth::user()->hasAnyPermission(['catalog-branch.edit', 'catalog-branch.destroy'])) {
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
            ->editColumn('name', function ($item) {
                if (!Auth::user()->hasPermission('catalog-branch.edit')) {
                    return $item->name;
                }
                return anchor_link(route('catalog-branch.edit', $item->id), $item->name);
            })
            ->editColumn('zone_id', function ($item) {
                if (!$item->zone_id) {
                    return null;
                }
                return anchor_link(route('catalog-zone.edit', $item->zone_id), $item->zone->name);
            })
            ->editColumn('checkbox', function ($item) {
                return table_checkbox($item->id);
            });
        return apply_filters(BASE_FILTER_GET_LIST_DATA, $data, $this->repository->getModel())
            ->addColumn('operations', function ($item) {
                return table_actions('catalog-branch.edit', 'catalog-branch.destroy', $item);
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
            'catalog_branches.id',
            'catalog_branches.zone_id',
            'catalog_branches.code',
            'catalog_branches.name',
        ]);

        return $this->applyScopes(apply_filters(BASE_FILTER_TABLE_QUERY, $query, $model));
    }

    /**
     * @return array
     * @since 2.1
     */
    public function columns()
    {
        return [
            'id' => [
                'name'  => 'catalog_branches.id',
                'title' => trans('core/base::tables.id'),
                'width' => '20px',
            ],
            'zone_id' => [
                'name'  => 'cities.zone_id',
                'title' => __('Vùng'),
                'class' => 'text-left',
            ],
            'code' => [
                'name'  => 'catalog_branches.code',
                'title' => __('Mã chi nhánh'),
                'class' => 'text-left',
            ],
            'name' => [
                'name'  => 'catalog_branches.name',
                'title' => __('Tên chi nhánh'),
                'class' => 'text-left',
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
        $buttons = $this->addCreateButton(route('catalog-branch.create'), 'catalog-branch.create');

        return apply_filters(BASE_FILTER_TABLE_BUTTONS, $buttons, CatalogBranch::class);
    }

    /**
     * @return array
     */
    public function getBulkChanges(): array
    {
        return [
            'catalog_branches.code' => [
                'title'    => __('Mã chi nhánh'),
                'type'     => 'text',
                'validate' => 'required|max:120',
            ],
            'catalog_branches.name' => [
                'title'    => trans('core/base::tables.name'),
                'type'     => 'text',
                'validate' => 'required|max:120',
            ],
        ];
    }
}
