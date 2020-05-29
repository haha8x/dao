<?php

namespace Botble\Catalog\Tables;

use Auth;
use Botble\Catalog\Repositories\Interfaces\CatalogZoneInterface;
use Botble\Table\Abstracts\TableAbstract;
use Illuminate\Contracts\Routing\UrlGenerator;
use Yajra\DataTables\DataTables;
use Botble\Catalog\Models\CatalogZone;

class CatalogZoneTable extends TableAbstract
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
     * CatalogZoneTable constructor.
     * @param DataTables $table
     * @param UrlGenerator $urlDevTool
     * @param CatalogZoneInterface $catalogZoneRepository
     */
    public function __construct(DataTables $table, UrlGenerator $urlDevTool, CatalogZoneInterface $catalogZoneRepository)
    {
        $this->repository = $catalogZoneRepository;
        $this->setOption('id', 'table-plugins-catalog-zone');
        parent::__construct($table, $urlDevTool);

        if (!Auth::user()->hasAnyPermission(['catalog-zone.edit', 'catalog-zone.destroy'])) {
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
                if (!Auth::user()->hasPermission('catalog-zone.edit')) {
                    return $item->name;
                }
                return anchor_link(route('catalog-zone.edit', $item->id), $item->name);
            })
            ->editColumn('checkbox', function ($item) {
                return table_checkbox($item->id);
            });

        return apply_filters(BASE_FILTER_GET_LIST_DATA, $data, $this->repository->getModel())
            ->addColumn('operations', function ($item) {
                return table_actions('catalog-zone.edit', 'catalog-zone.destroy', $item);
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
            'catalog_zones.id',
            'catalog_zones.code',
            'catalog_zones.name',
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
                'name'  => 'catalog_zones.id',
                'title' => trans('core/base::tables.id'),
                'width' => '20px',
            ],
            'code' => [
                'name'  => 'catalog_branches.code',
                'title' => __('Mã vùng'),
                'class' => 'text-left',
            ],
            'name' => [
                'name'  => 'catalog_zones.name',
                'title' => trans('core/base::tables.name'),
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
        $buttons = $this->addCreateButton(route('catalog-zone.create'), 'catalog-zone.create');

        return apply_filters(BASE_FILTER_TABLE_BUTTONS, $buttons, CatalogZone::class);
    }
}
