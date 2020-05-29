<?php

namespace Botble\Hr\Tables;

use Auth;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Hr\Repositories\Interfaces\HrInterface;
use Botble\ACL\Repositories\Interfaces\ActivationInterface;
use Botble\ACL\Repositories\Interfaces\UserInterface;
use Botble\Dao\Abstracts\TableAbstract;
use Illuminate\Contracts\Routing\UrlGenerator;
use Yajra\DataTables\DataTables;
use Botble\Hr\Models\Hr;
use Botble\ACL\Models\User;
use Botble\ACL\Enums\UserStatusEnum;
use Botble\ACL\Services\ActivateUserService;
use Botble\Base\Events\UpdatedContentEvent;
use Exception;
use Html;
use Illuminate\Support\Arr;

class HrTable extends TableAbstract
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
     * HrTable constructor.
     * @param DataTables $table
     * @param UrlGenerator $urlDevTool
     * @param HrInterface $hrRepository
     */
    public function __construct(
        DataTables $table,
        UrlGenerator $urlDevTool,
        UserInterface $userRepository,
        ActivateUserService $service
    ) {
        $this->repository = $userRepository;
        $this->service = $service;
        $this->setOption('id', 'table-plugins-hr');
        parent::__construct($table, $urlDevTool);

        if (!Auth::user()->hasAnyPermission(['hr.edit', 'hr.destroy'])) {
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
            ->editColumn('name', function ($item) {
                if (!Auth::user()->hasPermission('users.edit')) {
                    return $item->name;
                }

                return Html::link(route('user.profile.view', $item->id), $item->name);
            })
            ->editColumn('zone_id', function ($item) {
                return $item->zone ? $item->zone->name : null;
            })
            ->editColumn('branch_id', function ($item) {
                return $item->branch ? $item->branch->name : null;
            })
            ->editColumn('created_at', function ($item) {
                return date_from_database($item->created_at, config('core.base.general.date_format.date'));
            })
            ->editColumn('status', function ($item) {
                if (app(ActivationInterface::class)->completed($item)) {
                    return UserStatusEnum::ACTIVATED()->toHtml();
                }

                return UserStatusEnum::DEACTIVATED()->toHtml();
            })
            ->removeColumn('role_id');

        return apply_filters(BASE_FILTER_GET_LIST_DATA, $data, $this->repository->getModel())
            ->addColumn('operations', function ($item) {

                $action = null;
                if (Auth::user()->isSuperUser()) {
                    $action = Html::link(
                        route('user.activate', $item->id),
                        'Kích hoạt',
                        ['class' => 'btn btn-info']
                    )->toHtml();

                    if (app(ActivationInterface::class)->completed($item)) {
                        $action = Html::link(
                            route('user.deactivate', $item->id),
                            'Khoá',
                            ['class' => 'btn btn-danger']
                        )->toHtml();
                    }
                }

                return apply_filters(
                    ACL_FILTER_USER_TABLE_ACTIONS,
                    $action . view('core/acl::users.partials.actions', ['item' => $item])->render(),
                    $item
                );
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
        $query = $model->leftJoin('user_positions', 'user_positions.user_id', '=', 'users.id')
            ->select([
                'users.id',
                'users.name',
                'users.email',
                'users.created_at',
                'users.title',
                'users.dao',
                'users.staff_id',
                'user_positions.position_id as user_position',
                'user_positions.zone_id as user_zone',
                'user_positions.branch_id as user_branch',
            ]);

        return $this->applyScopes(apply_filters(BASE_FILTER_TABLE_QUERY, $query, $model));
    }

    public function columns()
    {
        return [
            'name'      => [
                'name'  => 'users.name',
                'title' => 'Họ và Tên',
                'class' => 'text-left',
            ],
            'title'      => [
                'name'  => 'users.title',
                'title' => 'Title',
                'class' => 'text-left',
            ],
            'dao'      => [
                'name'  => 'users.dao',
                'title' => 'DAO',
                'class' => 'text-left',
            ],
            'staff_id'      => [
                'name'  => 'users.staff_id',
                'title' => 'Mã nhân viên',
                'class' => 'text-left',
            ],
            'email'      => [
                'name'  => 'users.email',
                'title' => trans('core/acl::users.email'),
                'class' => 'text-left',
            ],
            'user_position' => [
                'name'  => 'user_position',
                'title' => 'Chức danh',
                'class' => 'text-left',
            ],
            'user_zone' => [
                'name'  => 'user_zone',
                'title' => 'Vùng',
                'class' => 'text-left',
            ],
            'user_branch' => [
                'name'  => 'users.user_branch',
                'title' => 'Chi nhánh',
                'class' => 'text-left',
            ],
            'created_at' => [
                'name'  => 'users.created_at',
                'title' => trans('core/base::tables.created_at'),
                'width' => '100px',
            ],
            'status'     => [
                'name'  => 'users.updated_at',
                'title' => trans('core/base::tables.status'),
                'width' => '100px',
            ],
        ];
    }

    public function getOperationsHeading()
    {
        return [
            'operations' => [
                'title'      => trans('core/base::tables.operations'),
                'width'      => '350px',
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
     * @since 2.1
     * @throws \Throwable
     */
    public function buttons()
    {
        $buttons = $this->addCreateButton(route('hr.create'), 'hr.create');

        return apply_filters(BASE_FILTER_TABLE_BUTTONS, $buttons, Hr::class);
    }

    /**
     * @return array
     * @throws \Throwable
     */
    public function bulkActions(): array
    {
        return $this->addDeleteAction(route('hr.deletes'), 'hr.destroy', parent::bulkActions());
    }

    /**
     * @return array
     */
    public function getBulkChanges(): array
    {
        return [
            'hrs.name' => [
                'title'    => trans('core/base::tables.name'),
                'type'     => 'text',
                'validate' => 'required|max:120',
            ],
            'hrs.status' => [
                'title'    => trans('core/base::tables.status'),
                'type'     => 'select',
                'choices'  => BaseStatusEnum::labels(),
                'validate' => 'required|in:' . implode(',', BaseStatusEnum::values()),
            ],
            'hrs.created_at' => [
                'title' => trans('core/base::tables.created_at'),
                'type'  => 'date',
            ],
        ];
    }
}
