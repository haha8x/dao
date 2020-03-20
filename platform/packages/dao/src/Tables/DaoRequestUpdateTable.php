<?php

namespace Botble\Dao\Tables;

use Auth;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Dao\Repositories\Interfaces\DaoRequestUpdateInterface;
use Botble\Table\Abstracts\TableAbstract;
use Illuminate\Contracts\Routing\UrlGenerator;
use Yajra\DataTables\DataTables;
use Botble\Dao\Models\DaoRequestUpdate;

class DaoRequestUpdateTable extends TableAbstract
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
     * DaoRequestUpdateTable constructor.
     * @param DataTables $table
     * @param UrlGenerator $urlDevTool
     * @param DaoRequestUpdateInterface $DaoRequestUpdateRepository
     */
    public function __construct(DataTables $table, UrlGenerator $urlDevTool, DaoRequestUpdateInterface $DaoRequestUpdateRepository)
    {
        $this->repository = $DaoRequestUpdateRepository;
        $this->setOption('id', 'table-plugins-request-update');
        parent::__construct($table, $urlDevTool);

        if (!Auth::user()->hasAnyPermission(['request-update.edit', 'request-update.destroy'])) {
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
            ->editColumn('created_at', function ($item) {
                return date_from_database($item->created_at, config('core.base.general.date_format.date'));
            })
            ->editColumn('status', function ($item) {
                return $item->status->toHtml();
            });

        return apply_filters(BASE_FILTER_GET_LIST_DATA, $data, $this->repository->getModel())
            ->addColumn('operations', function ($item) {
                return view('packages/dao::request.update.actions', compact('item'))->render();
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
            'dao_request_updates.dao_id',
            'dao_request_updates.dao_update',
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
                'name'  => 'dao_request_updates.zone_id',
                'title' => __('Vùng'),
                'class' => 'text-left',
            ],
            'branch_id' => [
                'name'  => 'dao_request_updates.branch_id',
                'title' => __('Chi nhánh'),
                'class' => 'text-left',
            ],
            'id' => [
                'name'  => 'dao_request_updates.id',
                'title' => __('Mã YC'),
                'class' => 'text-left',
            ],
            'name' => [
                'name'  => 'dao_request_updates.name',
                'title' => __('Nhân viên'),
                'class' => 'text-left',
            ],
            'dao' => [
                'name'  => 'dao_request_updates.dao',
                'title' => __('DAO Thay đổi'),
                'class' => 'text-left',
            ],
            'email' => [
                'name'  => 'dao_request_updates.email',
                'title' => __('Email'),
                'class' => 'text-left',
            ],
            'status_process' => [
                'name'  => 'dao_request_updates.status_process',
                'title' => __('Trạng thái'),
                'class' => 'text-left',
            ],
            'note_process' => [
                'name'  => 'dao_request_updates.note_process',
                'title' => __('Note'),
                'class' => 'text-left',
            ],
            'created_at' => [
                'name'  => 'dao_request_updates.created_at',
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
        $buttons = $this->addCreateButton(route('request-update.create'), 'request-update.create');

        return apply_filters(BASE_FILTER_TABLE_BUTTONS, $buttons, DaoRequestUpdate::class);
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
    public function getBulkChanges(): array
    {
        return [
            'dao_request_updates.status' => [
                'title'    => trans('core/base::tables.status'),
                'type'     => 'select',
                'choices'  => BaseStatusEnum::labels(),
                'validate' => 'required|in:' . implode(',', BaseStatusEnum::values()),
            ],
        ];
    }
}
