<?php

namespace Botble\Customer\Tables;

use Auth;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Customer\Repositories\Interfaces\CustomerInterface;
use Botble\Dao\Abstracts\TableAbstract;
use Illuminate\Contracts\Routing\UrlGenerator;
use Yajra\DataTables\DataTables;
use Botble\Customer\Models\Customer;

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
     * @param UrlGenerator $urlGenerator
     * @param CustomerInterface $customerRepository
     */
    public function __construct(DataTables $table, UrlGenerator $urlGenerator, CustomerInterface $customerRepository)
    {
        $this->repository = $customerRepository;
        $this->setOption('id', 'table-plugins-customer');
        parent::__construct($table, $urlGenerator);

        if (!Auth::user()->hasAnyPermission(['customer.edit', 'customer.destroy'])) {
            $this->hasOperations = false;
            $this->hasActions = false;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function ajax()
    {
        $data = $this->table
            ->eloquent($this->query())
            ->editColumn('name', function ($item) {
                if (!Auth::user()->hasPermission('customer.edit')) {
                    return $item->name;
                }
                return anchor_link(route('customer.edit', $item->id), $item->name);
            })
            ->editColumn('zone_id', function ($item) {
                return $item->zone ? $item->zone->name : null;
            })
            ->editColumn('branch_id', function ($item) {
                return $item->branch ? $item->branch->name : null;
            })
            ->editColumn('created_by', function ($item) {
                return $item->createdBy ? $item->createdBy->name : null;
            })
            ->editColumn('checkbox', function ($item) {
                return table_checkbox($item->id);
            })
            ->editColumn('open_date', function ($item) {
                return date_from_database($item->open_date, config('core.base.general.date_format.date'));
            })
            ->editColumn('created_at', function ($item) {
                return date_from_database($item->created_at, config('core.base.general.date_format.date'));
            });

        return apply_filters(BASE_FILTER_GET_LIST_DATA, $data, $this->repository->getModel())
            ->addColumn('operations', function ($item) {
                return table_actions('customer.edit', 'customer.destroy', $item);
            })
            ->escapeColumns([])
            ->make(true);
    }

    /**
     * {@inheritDoc}
     */
    public function query()
    {
        $model = $this->repository->getModel();
        $query = $model->select([
            'customers.id',
            'customers.cif',
            'customers.acctno',
            'customers.app_id_c',
            'customers.product_name',
            'customers.zone_id',
            'customers.branch_id',
            'customers.dao',
            'customers.open_date',
            'customers.name',
            'customers.created_by',
            'customers.created_at',
        ]);

        if (!Auth::user()->isSuperUser()) {
            if (Auth::user()->getPosition()->first()->code == 'GDCN') {
                $query = $model->where('branch_id', Auth::user()->getBranch()->first() ? Auth::user()->getBranch()->first()->id : null);
            } else {
                $query = $model->where('dao', Auth::user()->dao);
            }
        }

        return $this->applyScopes(apply_filters(BASE_FILTER_TABLE_QUERY, $query, $model));
    }

    /**
     * {@inheritDoc}
     */
    public function columns()
    {
        return [
            'id' => [
                'name'  => 'customers.id',
                'title' => trans('core/base::tables.id'),
                'width' => '20px',
            ],
            'name' => [
                'name'  => 'customers.name',
                'title' => 'Tên khách hàng',
                'class' => 'text-left',
            ],
            'cif' => [
                'name'  => 'customers.cif',
                'title' => 'CIF',
                'class' => 'text-left',
            ],
            'acctno' => [
                'name'  => 'customers.acctno',
                'title' => 'ACCTNO',
                'class' => 'text-left',
            ],
            'app_id_c' => [
                'name'  => 'customers.app_id_c',
                'title' => 'APP ID C',
                'class' => 'text-left',
            ],
            'product_name' => [
                'name'  => 'customers.product_name',
                'title' => 'Product Name',
                'class' => 'text-left',
            ],
            'zone_id' => [
                'name'  => 'customers.zone_id',
                'title' => 'Vùng',
                'class' => 'text-left',
            ],
            'branch_id' => [
                'name'  => 'customers.branch_id',
                'title' => 'Chi nhánh',
                'class' => 'text-left',
            ],
            'dao' => [
                'name'  => 'customers.dao',
                'title' => 'DAO',
                'class' => 'text-left',
            ],
            'open_date' => [
                'name'  => 'customers.open_date',
                'title' => 'Ngày mở',
                'class' => 'text-left',
            ],
            'created_at' => [
                'name'  => 'customers.created_at',
                'title' => trans('core/base::tables.created_at'),
                'width' => '100px',
            ],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function buttons()
    {
        $buttons = $this->addCreateButton(route('customer.create'), 'customer.create');

        return apply_filters(BASE_FILTER_TABLE_BUTTONS, $buttons, Customer::class);
    }

    /**
     * {@inheritDoc}
     */
    public function bulkActions(): array
    {
        return $this->addDeleteAction(route('customer.deletes'), 'customer.destroy', parent::bulkActions());
    }

    /**
     * {@inheritDoc}
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
