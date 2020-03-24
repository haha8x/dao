<?php

namespace Botble\Dao\Forms;

use Botble\Base\Forms\FormAbstract;
use Botble\Catalog\Repositories\Interfaces\CatalogBranchInterface;
use Botble\Catalog\Repositories\Interfaces\CatalogPositionInterface;
use Botble\Catalog\Repositories\Interfaces\CatalogZoneInterface;
use Botble\Dao\Http\Requests\RequestNewRequest;
use Botble\Dao\Models\DaoRequestNew;

class RequestNewForm extends FormAbstract
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
            ->setupModel(new DaoRequestNew)
            ->setFormOption('template', 'plugins/dao::forms.register.base')
            ->setFormOption('enctype', 'multipart/form-data')
            ->setValidatorClass(RequestNewRequest::class)
            ->setActionButtons(view('plugins/dao::forms.register.actions')->render())
            ->add('zone_id', 'select', [
                'label' => __('Vùng'),
                'label_attr' => ['class' => 'control-label required'],
                'choices' => $catalogZone,
            ])
            ->add('branch_id', 'select', [
                'label'      => __('Chi nhánh'),
                'label_attr' => ['class' => 'control-label required'],
                'choices' => $catalogBranch,
            ])
            ->add('staff_name', 'text', [
                'label'      => __('Họ tên CBBH'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => __('Nhập tên đúng, in hoa, không dấu'),
                    'data-counter' => 120,
                ],
            ])
            ->add('position_id', 'select', [
                'label' => __('Chức danh'),
                'label_attr' => ['class' => 'control-label required'],
                'choices' => $catalogPosition,
            ])
            ->add('status_dao', 'text', [
                'label'      => __('Trạng thái DAO'),
                'label_attr' => ['class' => 'control-label required read'],
                'value'      => 60,
                'attr'       => [
                    'placeholder'  => __('60'),
                    'data-counter' => 2,
                    'readonly' => true,
                ],
            ])
            ->add('staff_id', 'text', [
                'label'      => __('Mã nhân viên'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => __('Nhập mã nhân viên'),
                    'data-counter' => 120,
                ],
            ])
            ->add('cif', 'text', [
                'label'      => __('CIF'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => __('Nhập CIF nhân viên'),
                    'data-counter' => 120,
                ],
            ])
            ->add('email', 'text', [
                'label'      => __('Email'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => __('Nhập địa chỉ email@vpbank.com.vn'),
                    'data-counter' => 120,
                ],
            ])
            ->add('cmnd', 'text', [
                'label'      => __('CMND'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => __('Nhập CMND'),
                    'data-counter' => 120,
                ],
            ])
            ->add('phone', 'text', [
                'label'      => __('Số điện thoại'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => __('Nhập địa chỉ Số điện thoại'),
                    'data-counter' => 120,
                ],
            ])
            ->add('decision_file', 'file', [
                'label'      => __('QĐ / Thư mời làm việc'),
                'label_attr' => ['class' => 'control-label required'],
            ])
            ;
    }
}
