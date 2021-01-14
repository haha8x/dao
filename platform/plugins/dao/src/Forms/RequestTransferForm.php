<?php

namespace Botble\Dao\Forms;

use Botble\Base\Forms\FormAbstract;
use Botble\Dao\Http\Requests\RequestTransferRequest;
use Botble\Dao\Models\RequestTransfer;
use Botble\Catalog\Repositories\Interfaces\CatalogZoneInterface;
use Assets;
use Botble\Dao\Enums\TransferTypeEnum;
use Auth;
use Botble\Customer\Repositories\Interfaces\CustomerInterface;

class RequestTransferForm extends FormAbstract
{
    protected $catalogZoneInterface;
    protected $customerRepository;

    public function __construct(
        CatalogZoneInterface $catalogZoneRepository,
        CustomerInterface $customerRepository
    ) {
        parent::__construct();
        $this->customerRepository = $customerRepository;
        $this->catalogZoneRepository = $catalogZoneRepository;
    }

    /**
     * @return mixed|void
     * @throws \Throwable
     */
    public function buildForm()
    {

        Assets::addScriptsDirectly('vendor/core/plugins/dao/js/request-transfer.js');
        Assets::addScriptsDirectly('vendor/core/plugins/catalog/js/catalog.js');

        if (!Auth::user()->isSuperUser()) {
            $catalogZone = app(CatalogZoneInterface::class)
                ->getModel()
                ->where('id', Auth::user()->getZone()->first() ? Auth::user()->getZone()->first()->id : null)
                ->pluck('name', 'id')
                ->all();
        } else {
            $catalogZone = $this->catalogZoneRepository->pluck('name', 'id');
        }

        if (!Auth::user()->isSuperUser()) {
            $customer = app(CustomerInterface::class)
                ->getModel()
                ->where('dao', Auth::user()->dao ? Auth::user()->dao : null)
                ->pluck('name', 'id')
                ->all();
        } else {
            $customer = $this->customerRepository->pluck('name', 'id');
        }

        $this
            ->setupModel(new RequestTransfer)
            ->setValidatorClass(RequestTransferRequest::class)
            ->withCustomFields()
            ->add('type', 'select', [
                'label' => __('Yêu cầu'),
                'label_attr' => ['class' => 'control-label required'],
                'choices'    => TransferTypeEnum::labels(),
            ])
            ->add('rowOpen1', 'html', [
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
                    'data-origin-value' => $this->model->branch_id,
                ],
                'wrapper'    => [
                    'class' => 'form-group col-md-6',
                ],
            ])
            ->add('rowClose1', 'html', [
                'html' => '</div>',
            ])
            ->add('ref_no', 'text', [
                'label'      => __('CIF'),
                'label_attr' => ['class' => 'control-label required ref_no_label'],
                'attr'       => [
                    'data-counter' => 120,
                ],
            ])
            ->add('customer_id', 'select', [
                'label' => __('Tên khách hàng'),
                'label_attr' => ['class' => 'control-label required'],
                'choices' => $customer,
                'attr'       => [
                    'class' => 'form-control select-search-full',
                ],
            ])
            ->add('rowOpen2', 'html', [
                'html' => '<div class="row">',
            ])
            // ->add('dao_old', 'text', [
            //     'label'      => __('DAO cũ'),
            //     'label_attr' => ['class' => 'control-label required'],
            //     'attr'       => [
            //         'placeholder'  => __('Nhập DAO cũ'),
            //         'data-counter' => 120,
            //     ],
            //     'wrapper'    => [
            //         'class' => 'form-group col-md-6',
            //     ],
            // ])
            ->add('dao_transfer', 'text', [
                'label'      => __('DAO mới'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => __('Nhập DAO mới'),
                    'data-counter' => 120,
                ],
                'wrapper'    => [
                    'class' => 'form-group col-md-12',
                ],
            ])
            ->add('rowClose2', 'html', [
                'html' => '</div>',
            ])
            ->add('reason', 'select', [
                'label' => __('Lý do'),
                'label_attr' => ['class' => 'control-label require'],
                'choices' => [
                    'Do phân bổ lại CB quản lý KH' => __('Do phân bổ lại CB quản lý KH'),
                    'Do CBBH nghỉ việc/buộc thôi việc/điều chuyển sang bộ phận khác' => __('Do CBBH nghỉ việc/buộc thôi việc/điều chuyển sang bộ phận khác'),
                    'other' => __('Khác'),
                ],
            ])
            ->add('note', 'text', [
                'label'      => __('Note (Nếu chọn lý do khác)'),
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'placeholder'  => __('Nhập lý do khác'),
                    'data-counter' => 120,
                ],
                'wrapper' => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ($this->getModel() ? ' hidden' : null),
                ],
            ]);
    }
}
