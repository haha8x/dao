<?php

namespace Botble\Dao\Forms;

use Botble\ACL\Http\Requests\CreateUserRequest;
use Botble\ACL\Models\User;
use Botble\Base\Forms\FormAbstract;
use Botble\Catalog\Repositories\Interfaces\CatalogBranchInterface;
use Botble\Catalog\Repositories\Interfaces\CatalogPositionInterface;
use Botble\Catalog\Repositories\Interfaces\CatalogZoneInterface;

class StaffForm extends FormAbstract
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
            ->setupModel(new User)
            ->setFormOption('template', 'plugins/dao::forms.register.base')
            ->setFormOption('enctype', 'multipart/form-data')
            ->setValidatorClass(CreateUserRequest::class)
            ->setActionButtons(view('plugins/dao::forms.register.actions')->render())
            ->add('username', 'hidden', [
                'value' => 'abcdef',
            ])
            ->add('first_name', 'hidden', [
                'value' => 'abcdef',
            ])
            ->add('last_name', 'hidden', [
                'value' => 'abcdef',
            ])
            ->add('staff_id', 'text', [
                'label'      => __('Mã nhân viên'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => __('Nhập mã nhân viên'),
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
            ->add('password', 'password', [
                'label'      => 'Mật khẩu',
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'data-counter' => 60,
                ],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ($this->getModel()->id ? ' hidden' : null),
                ],
            ])
            ->add('password_confirmation', 'password', [
                'label'      => 'Xác nhận Mật khẩu',
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'data-counter' => 60,
                ],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ($this->getModel()->id ? ' hidden' : null),
                ],
            ])
            ->add('branch_id', 'select', [
                'label'      => __('Chi nhánh'),
                'label_attr' => ['class' => 'control-label required'],
                'choices' => $catalogBranch,
            ])
            ->add('zone_id', 'select', [
                'label' => __('Vùng'),
                'label_attr' => ['class' => 'control-label required'],
                'choices' => $catalogZone,
            ])
            ->add('position_id', 'select', [
                'label' => __('Chức danh'),
                'label_attr' => ['class' => 'control-label required'],
                'choices' => $catalogPosition,
            ])
            ->add('active', 'checkbox', [
                'label' => __('Kích hoạt'),
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'class' => 'hrv-checkbox',
                ],
                'value' => 1,
                'checked' => true
            ]);
    }
}
