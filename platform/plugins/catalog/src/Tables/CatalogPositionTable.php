<?php

namespace Botble\Catalog\Tables;

use Auth;
use Botble\Catalog\Repositories\Interfaces\CatalogPositionInterface;
use Botble\Table\Abstracts\TableAbstract;
use Illuminate\Contracts\Routing\UrlGenerator;
use Yajra\DataTables\DataTables;
use Botble\Catalog\Models\CatalogPosition;

class CatalogPositionTable extends TableAbstract
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
     * CatalogPositionTable constructor.
     * @param DataTables $table
     * @param UrlGenerator $urlDevTool
     * @param CatalogPositionInterface $catalogPositionRepository
     */
    public function __construct(DataTables $table, UrlGenerator $urlDevTool, CatalogPositionInterface $catalogPositionRepository)
    {
        $this->repository = $catalogPositionRepository;
        $this->setOption('id', 'table-plugins-catalog-position');
        parent::__construct($table, $urlDevTool);

        if (!Auth::user()->hasAnyPermission(['catalog-position.edit', 'catalog-position.destroy'])) {
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
                if (!Auth::user()->hasPermission('catalog-position.edit')) {
                    return $item->name;
                }
                return anchor_link(route('catalog-position.edit', $item->id), $item->name);
            })
            ->editColumn('checkbox', function ($item) {
                return table_checkbox($item->id);
            });

        return apply_filters(BASE_FILTER_GET_LIST_DATA, $data, $this->repository->getModel())
            ->addColumn('operations', function ($item) {
                return table_actions('catalog-position.edit', 'catalog-position.destroy', $item);
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
            'catalog_positions.id',
            'catalog_positions.name',
        ])->orderBy('name', 'asc');

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
                'name'  => 'catalog_positions.id',
                'title' => trans('core/base::tables.id'),
                'width' => '20px',
            ],
            'name' => [
                'name'  => 'catalog_positions.name',
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
        $buttons = $this->addCreateButton(route('catalog-position.create'), 'catalog-position.create');

        return apply_filters(BASE_FILTER_TABLE_BUTTONS, $buttons, CatalogPosition::class);
    }
}
