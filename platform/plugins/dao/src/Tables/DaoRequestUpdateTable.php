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
        $this->setOption('id', 'table-plugins-dao-request-update');
        parent::__construct($table, $urlDevTool);

        if (!Auth::user()->hasAnyPermission(['dao-request-update.edit', 'dao-request-update.destroy'])) {
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
                return ('Vùng '.$item->zone_id);
            })
            ->editColumn('id', function ($item) {
                return ('DAO'.$item->id);
            })
            ->editColumn('created_at', function ($item) {
                return date_from_database($item->created_at, config('core.base.general.date_format.date'));
            });

        return apply_filters(BASE_FILTER_GET_LIST_DATA, $data, $this->repository->getModel())
            ->addColumn('operations', function ($item) {
                return table_actions('dao-request-update.edit', 'dao-request-update.destroy', $item);
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
            'daos.zone_id',
            'daos.branch_code',
            'daos.dao',
            'daos.id',
            'daos.name',
            'daos.chuc_danh',
            'daos.status_dao',
            'daos.email',
            'daos.cif',
            'daos.cmnd',
            'daos.phone',
            'daos.status_process',
            'daos.note_process',
            'daos.created_at',
        ])->where('request_type', 'update');

        if (!Auth::user()->isSuperUser()){
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
            'branch_code' => [
                'name'  => 'daos.branch_code',
                'title' => __('Chi nhánh'),
                'class' => 'text-left',
            ],
            'id' => [
                'name'  => 'daos.id',
                'title' => __('Mã YC'),
                'class' => 'text-left',
            ],
            'name' => [
                'name'  => 'daos.name',
                'title' => __('Nhân viên'),
                'class' => 'text-left',
            ],
            'dao' => [
                'name'  => 'daos.dao',
                'title' => __('DAO Thay đổi'),
                'class' => 'text-left',
            ],
            'email' => [
                'name'  => 'daos.email',
                'title' => __('Email'),
                'class' => 'text-left',
            ],
            'status_process' => [
                'name'  => 'daos.status_process',
                'title' => __('Trạng thái'),
                'class' => 'text-left',
            ],
            'note_process' => [
                'name'  => 'daos.note_process',
                'title' => __('Note'),
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
     * @since 2.1
     * @throws \Throwable
     */
    public function buttons()
    {
        $buttons = $this->addCreateButton(route('dao-request-update.create'), 'dao-request-update.create');

        return apply_filters(BASE_FILTER_TABLE_BUTTONS, $buttons, DaoRequestUpdate::class);
    }

    /**
     * @return array
     * @throws \Throwable
     */
    public function bulkActions(): array
    {
        return $this->addDeleteAction(route('dao-request-update.deletes'), 'dao-request-update.destroy', parent::bulkActions());
    }

    /**
     * @return array
     */
    public function getBulkChanges(): array
    {
        return [
            'daos.name' => [
                'title'    => trans('core/base::tables.name'),
                'type'     => 'text',
                'validate' => 'required|max:120',
            ],
            'daos.status' => [
                'title'    => trans('core/base::tables.status'),
                'type'     => 'select',
                'choices'  => BaseStatusEnum::labels(),
                'validate' => 'required|in:' . implode(',', BaseStatusEnum::values()),
            ],
            'daos.created_at' => [
                'title' => trans('core/base::tables.created_at'),
                'type'  => 'date',
            ],
        ];
    }
}
