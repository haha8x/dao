<?php

namespace Botble\Customer\Forms;

use Botble\Base\Forms\FormAbstract;
use Botble\Customer\Http\Requests\CustomerRequest;
use Botble\Customer\Models\Customer;
use Assets;
use Botble\Catalog\Repositories\Interfaces\CatalogZoneInterface;

class CustomerForm extends FormAbstract
{

    protected $catalogZoneInterface;

    public function __construct(
        CatalogZoneInterface $catalogZoneRepository
    ) {
        parent::__construct();
        $this->catalogZoneRepository = $catalogZoneRepository;
    }
    /**
     * {@inheritDoc}
     */
    public function buildForm()
    {
        Assets::addScriptsDirectly('vendor/core/plugins/catalog/js/catalog.js')
            ->addStyles(['datetimepicker']);

        $catalogZone = $this->catalogZoneRepository->pluck('catalog_zones.name', 'catalog_zones.id');
        $this
            ->setupModel(new Customer)
            ->setValidatorClass(CustomerRequest::class)
            ->withCustomFields()
            ->add('customer_name', 'text', [
                'label'      => 'Tên Khách hàng',
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'data-counter' => 120,
                ],
            ])
            ->add('cif', 'text', [
                'label'      => 'CIF',
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'data-counter' => 120,
                ],
            ])->add('acctno', 'text', [
                'label'      => 'ACCT NO',
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'data-counter' => 120,
                ],
            ])->add('app_id_c', 'text', [
                'label'      => 'APP ID C',
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'data-counter' => 120,
                ],
            ])->add('product_name', 'text', [
                'label'      => 'Tên sản phẩm',
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'data-counter' => 120,
                ],
            ])->add('rowOpen1', 'html', [
                'html' => '<div class="row">',
            ])
            ->add('zone_id', 'select', [
                'label' => __('Vùng'),
                'label_attr' => ['class' => 'control-label required'],
                'choices' => $catalogZone,
                'attr'       => [
                    'class' => 'form-control select-search-full',
                    'data-type' => 'zone',
                    'data-target' => '#branch_id',
                    'data-change-zone-url' => route('get-branch'),
                ],
                'wrapper'    => [
                    'class' => 'form-group col-md-6',
                ],
            ])
            ->add('branch_id', 'select', [
                'label'      => __('Chi nhánh'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'class' => 'form-control select-search-full',
                    'data-type' => 'branch',
                    'data-placeholder' => __('Chọn chi nhánh'),
                ],
                'wrapper'    => [
                    'class' => 'form-group col-md-6',
                ],
            ])
            ->add('rowClose1', 'html', [
                'html' => '</div>',
            ])->add('staff_id', 'text', [
                'label'      => 'Mã nhân viên',
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'data-counter' => 120,
                ],
            ])->add('open_date', 'text', [
                'label' => __('Open Date'),
                'label_attr' => ['class' => 'control-label required'],
                'attr' => [
                    'data-counter' => 30,
                    'class' => 'form-control datepicker',
                    'data-date-format' => config('core.base.general.date_format.js.date'),
                ],
            ]);
    }
}
