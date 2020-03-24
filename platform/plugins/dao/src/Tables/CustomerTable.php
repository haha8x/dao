<?php

namespace Botble\Dao\Tables;

use Auth;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Dao\Repositories\Interfaces\CustomerInterface;
use Botble\Table\Abstracts\TableAbstract;
use Illuminate\Contracts\Routing\UrlGenerator;
use Yajra\DataTables\DataTables;
use Botble\Dao\Models\Customer;

class CustomerTable extends TableAbstract
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
     * CustomerTable constructor.
     * @param DataTables $table
     * @param UrlGenerator $urlDevTool
     * @param CustomerInterface $customerRepository
     */
    public function __construct(DataTables $table, UrlGenerator $urlDevTool, CustomerInterface $customerRepository)
    {
        $this->repository = $customerRepository;
        $this->setOption('id', 'table-plugins-customer');
        parent::__construct($table, $urlDevTool);

        if (!Auth::user()->hasAnyPermission(['customer.edit', 'customer.destroy'])) {
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
            ->editColumn('open_date', function ($item) {
                return date_from_database($item->open_date, config('core.base.general.date_format.date'));
            });

        return apply_filters(BASE_FILTER_GET_LIST_DATA, $data, $this->repository->getModel())
            ->addColumn('operations', function ($item) {
                return table_actions('customer.edit', 'customer.destroy', $item);
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
            'customers.id',
            'customers.acctno',
            'customers.cif',
            'customers.name',
            'customers.product_name',
            'customers.branch_id',
            'customers.dao_id',
            'customers.open_date',
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
                'name'  => 'customers.id',
                'title' => trans('core/base::tables.id'),
                'width' => '20px',
            ],
            'acctno' => [
                'name'  => 'customers.acctno',
                'title' => __('ACCTNO'),
                'class' => 'text-left',
            ],
            'cif' => [
                'name'  => 'customers.cif',
                'title' => __('CIF'),
                'class' => 'text-left',
            ],
            'name' => [
                'name'  => 'customers.name',
                'title' => __('Khách hàng'),
                'class' => 'text-left',
            ],
            'product_name' => [
                'name'  => 'customers.product_name',
                'title' => __('Sản phẩm'),
                'class' => 'text-left',
            ],
            'branch_id' => [
                'name'  => 'customers.branch_id',
                'title' => __('Chi nhánh'),
                'class' => 'text-left',
            ],
            'dao_id' => [
                'name'  => 'customers.dao_id',
                'title' => __('DAO'),
                'class' => 'text-left',
            ],
            'open_date' => [
                'name'  => 'customers.open_date',
                'title' => __('Ngày mở'),
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
        $buttons = $this->addCreateButton(route('customer.create'), 'customer.create');

        return apply_filters(BASE_FILTER_TABLE_BUTTONS, $buttons, Customer::class);
    }

    /**
     * @return array
     * @throws \Throwable
     */
    public function bulkActions(): array
    {
        return $this->addDeleteAction(route('customer.deletes'), 'customer.destroy', parent::bulkActions());
    }

    /**
     * @return array
     */
    public function getBulkChanges(): array
    {
        return [
            'customers.name' => [
                'title'    => trans('core/base::tables.name'),
                'type'     => 'text',
                'validate' => 'required|max:120',
            ],
            'customers.status' => [
                'title'    => trans('core/base::tables.status'),
                'type'     => 'select',
                'choices'  => BaseStatusEnum::labels(),
                'validate' => 'required|in:' . implode(',', BaseStatusEnum::values()),
            ],
            'customers.created_at' => [
                'title' => trans('core/base::tables.created_at'),
                'type'  => 'date',
            ],
        ];
    }
}
