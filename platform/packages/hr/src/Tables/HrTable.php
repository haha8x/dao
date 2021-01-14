<?php

namespace Botble\Hr\Tables;

use Auth;
use Botble\Hr\Repositories\Interfaces\HrInterface;
use Botble\ACL\Repositories\Interfaces\ActivationInterface;
use Botble\ACL\Repositories\Interfaces\UserInterface;
use Botble\Dao\Abstracts\TableAbstract;
use Illuminate\Contracts\Routing\UrlGenerator;
use Yajra\DataTables\DataTables;
use Botble\Hr\Models\Hr;
use Botble\ACL\Enums\UserStatusEnum;
use Botble\ACL\Services\ActivateUserService;
use Html;

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
        $this->setOption('id', 'table-packages-hr');
        parent::__construct($table, $urlDevTool);

        if (!Auth::user()->hasAnyPermission(['users.edit', 'users.destroy'])) {
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
            ->editColumn('avatar_id', function ($item) {
                return implode(', ', $item->positions->pluck('name')->all());
            })
            ->editColumn('role_name', function ($item) {
                if (!Auth::user()->hasPermission('users.edit')) {
                    return $item->role_name;
                }

                return view('core/acl::users.partials.role', ['item' => $item])->render();
            })
            ->editColumn('last_login', function ($item) {
                return implode(', ', $item->zones->pluck('name')->all());
            })
            ->editColumn('updated_at', function ($item) {
                return implode(', ', $item->branchs->pluck('name')->all());
            })
            ->editColumn('created_at', function ($item) {
                return date_from_database($item->created_at, config('core.base.general.date_format.date'));
            })
            // ->editColumn('title', function ($item) {
            //     return $item->title ? $item->title->toHtml() : null;
            // })
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
        $query = $model
            ->with(['positions'])
            // ->leftJoin('role_users', 'users.id', '=', 'role_users.user_id')
            // ->leftJoin('roles', 'roles.id', '=', 'role_users.role_id')
            ->join('activations', 'users.id', '=', 'activations.user_id')
            ->select([
                'users.id',
                'users.name',
                'users.email',
                'users.created_at',
                'users.updated_at',
                'users.last_login',
                'users.avatar_id',
                'users.title',
                'users.dao',
                'users.staff_id',
                // 'roles.name as role_name',
                // 'roles.id as role_id',
            ])->where('users.super_user', '=', 0);

        return $this->applyScopes(apply_filters(BASE_FILTER_TABLE_QUERY, $query, $model));
    }

    public function columns()
    {
        return [
            'name'      => [
                'name'  => 'users.name',
                'title' => 'Họ và Tên',
                'class' => 'text-left',
                'width' => '150px',
            ],
            // 'title'      => [
            //     'name'  => 'users.title',
            //     'title' => 'Title',
            //     'class' => 'text-left',
            // ],
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
            'avatar_id' => [
                'name'  => 'users.avatar_id',
                'title' => 'Chức danh',
                'class' => 'text-left',
            ],
            // 'role_name'  => [
            //     'name'       => 'role_name',
            //     'title'      => trans('core/acl::users.role'),
            //     'searchable' => false,
            // ],
            'last_login' => [
                'name'  => 'users.last_login',
                'title' => 'Vùng',
                'class' => 'text-left',
                'width' => '50px',
            ],
            'updated_at' => [
                'name'  => 'users.updated_at',
                'title' => 'Chi nhánh',
                'class' => 'text-left',
                'width' => '150px',
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
        $buttons = $this->addCreateButton(route('users.create'), 'users.create');

        return apply_filters(BASE_FILTER_TABLE_BUTTONS, $buttons, Hr::class);
    }

    /**
     * @return array
     * @throws \Throwable
     */
    public function bulkActions(): array
    {
        return $this->addDeleteAction(route('users.deletes'), 'users.destroy', parent::bulkActions());
    }

    /**
     * @return array
     */
    public function getBulkChanges(): array
    {
        return [
            'users.email'      => [
                'title'    => trans('core/base::tables.email'),
                'type'     => 'text',
                'validate' => 'required|max:120|email',
            ],
            'users.created_at' => [
                'title' => trans('core/base::tables.created_at'),
                'type'  => 'date',
            ],
        ];
    }
}
