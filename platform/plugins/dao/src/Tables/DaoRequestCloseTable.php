<?php

namespace Botble\Dao\Tables;

use Auth;
use Botble\Dao\Repositories\Interfaces\DaoRequestCloseInterface;
use Botble\Table\Abstracts\TableAbstract;
use Illuminate\Contracts\Routing\UrlGenerator;
use Yajra\DataTables\DataTables;
use Botble\Dao\Models\DaoRequestClose;
use Botble\Dao\Enums\RequestStatusEnum;
use Html;

class DaoRequestCloseTable extends TableAbstract
{

    /**
     * @var bool
     */
    protected $hasActions = true;

    /**
     * @var bool
     */
    protected $hasFilter = true;

    /**
     * DaoRequestCloseTable constructor.
     * @param DataTables $table
     * @param UrlGenerator $urlDevTool
     * @param DaoRequestCloseInterface $DaoRequestCloseRepository
     */
    public function __construct(DataTables $table, UrlGenerator $urlDevTool, DaoRequestCloseInterface $DaoRequestCloseRepository)
    {
        $this->repository = $DaoRequestCloseRepository;
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
                return ('Vùng ' . $item->zone_id);
            })
            ->editColumn('id', function ($item) {
                return ('DAO' . $item->id);
            })
            ->editColumn('dao_id', function ($item) {
                return $item->dao->dao;
            })
            ->editColumn('created_at', function ($item) {
                return date_from_database($item->created_at, config('core.base.general.date_format.date'));
            })
            ->editColumn('status', function ($item) {
                return $item->status->toHtml();
            });

        return apply_filters(BASE_FILTER_GET_LIST_DATA, $data, $this->repository->getModel())
            ->addColumn('operations', function ($item) {
                return view('plugins/dao::request.close.actions', compact('item'))->render();
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
            'dao_request_closes.id',
            'dao_request_closes.dao_id',
            'dao_request_closes.status',
            'dao_request_closes.note',
            'dao_request_closes.created_at',
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
            'id' => [
                'name'  => 'dao_request_closes.id',
                'title' => __('Mã YC'),
                'class' => 'text-left',
            ],
            'dao_id' => [
                'name'  => 'dao_request_closes.dao',
                'title' => __('DAO cần đóng'),
                'class' => 'text-left',
            ],
            'status' => [
                'name'  => 'dao_request_closes.status',
                'title' => __('Trạng thái xử lý'),
                'class' => 'text-left',
            ],
            'note' => [
                'name'  => 'dao_request_closes.note',
                'title' => __('Note'),
                'class' => 'text-left',
            ],
            'created_at' => [
                'name'  => 'dao_request_closes.created_at',
                'title' => trans('core/base::tables.created_at'),
                'width' => '100px',
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

        return apply_filters(BASE_FILTER_TABLE_BUTTONS, $buttons, DaoRequestClose::class);
    }

    /**
     * @return array
     */
    public function getBulkChanges(): array
    {
        return [
            'dao_request_closes.status' => [
                'title'    => trans('core/base::tables.status'),
                'type'     => 'select',
                'choices'  => RequestStatusEnum::labels(),
                'validate' => 'required|in:' . implode(',', RequestStatusEnum::values()),
            ],
        ];
    }
}