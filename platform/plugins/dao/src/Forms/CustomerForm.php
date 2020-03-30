<?php

namespace Botble\Dao\Forms;

use Botble\Base\Forms\FormAbstract;
use Botble\Dao\Http\Requests\CustomerRequest;
use Botble\Dao\Models\Customer;
use Botble\Catalog\Repositories\Interfaces\CatalogBranchInterface;
use Botble\Catalog\Repositories\Interfaces\CatalogPositionInterface;
use Botble\Catalog\Repositories\Interfaces\CatalogZoneInterface;

class CustomerForm extends FormAbstract
{

    protected $catalogBranchInterface;
    protected $catalogZoneInterface;
    protected $catalogPositionInterface;

    public function __construct(
        CatalogBranchInterface $catalogBranchRepository,
        CatalogZoneInterface $catalogZoneRepository,
        CatalogPositionInterface $catalogPositionRepository
    ) {
        parent::__construct();

        $this->catalogBranchRepository = $catalogBranchRepository;
        $this->catalogZoneRepository = $catalogZoneRepository;
        $this->catalogPositionRepository = $catalogPositionRepository;
    }

    /**
     * @return mixed|void
     * @throws \Throwable
     */
    public function buildForm()
    {
        $catalogBranch = $this->catalogBranchRepository->pluck('catalog_branches.name', 'catalog_branches.id');
        $catalogZone = $this->catalogZoneRepository->pluck('catalog_zones.name', 'catalog_zones.id');
        $catalogPosition = $this->catalogPositionRepository->pluck('catalog_positions.name', 'catalog_positions.id');

        $this
            ->setupModel(new Customer)
            ->setValidatorClass(CustomerRequest::class)
            ->withCustomFields()
            ->add('acct_no', 'text', [
                'label'      => __('ACCT No'),
                'label_attr' => ['class' => 'control-label required'],
            ])
            ->add('cif', 'text', [
                'label'      => __('CIF'),
                'label_attr' => ['class' => 'control-label required'],
            ])
            ->add('customer_name', 'text', [
                'label'      => __('Tên khách hàng'),
                'label_attr' => ['class' => 'control-label required'],
            ])
            ->add('product_name', 'text', [
                'label'      => __('Tên sản phẩm'),
                'label_attr' => ['class' => 'control-label required'],
            ])
            ->add('branch_id', 'select', [
                'label'      => __('Chi nhánh'),
                'label_attr' => ['class' => 'control-label required'],
                'choices' => $catalogBranch,
            ])
            ->add('dao', 'text', [
                'label'      => __('DAO'),
                'label_attr' => ['class' => 'control-label required'],
            ])
            ->add('open_date', 'text', [
                'label' => __('Ngày mở'),
                'label_attr' => ['class' => 'control-label'],
                'attr' => [
                    'data-counter' => 30,
                    'class' => 'form-control datepicker',
                    'data-date-format' => config('core.base.general.date_format.js.date'),
                ],
            ])
            ->setBreakFieldPoint('status');
    }
}
