<?php

namespace Botble\Hr\Forms;

use Botble\ACL\Http\Requests\CreateUserRequest;
use Botble\ACL\Models\User;
use Botble\Base\Forms\FormAbstract;
use Botble\Catalog\Repositories\Interfaces\CatalogBranchInterface;
use Botble\Catalog\Repositories\Interfaces\CatalogPositionInterface;
use Botble\Catalog\Repositories\Interfaces\CatalogZoneInterface;
use Assets;

class RegisterUserForm extends FormAbstract
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
        Assets::addScriptsDirectly('vendor/core/plugins/catalog/js/catalog.js');

        $catalogBranch = $this->catalogBranchRepository->pluck('catalog_branches.name', 'catalog_branches.id');
        $catalogZone = $this->catalogZoneRepository->pluck('catalog_zones.name', 'catalog_zones.id');
        $catalogPosition = $this->catalogPositionRepository->pluck('catalog_positions.name', 'catalog_positions.id');

        $this
            ->setupModel(new User)
            ->setFormOption('template', 'plugins/dao::forms.register.base')
            ->setFormOption('enctype', 'multipart/form-data')
            ->setValidatorClass(CreateUserRequest::class)
            ->setActionButtons(view('plugins/dao::forms.register.actions')->render())
            ->add('name', 'text', [
                'label'      => __('Họ và Tên'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => __('Nhập Họ và Tên'),
                ],
            ])
            ->add('staff_id', 'text', [
                'label'      => __('Mã nhân viên'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => __('Nhập mã nhân viên'),
                ],
            ])
            ->add('email', 'text', [
                'label'      => __('Email'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => __('Nhập địa chỉ email@vpbank.com.vn'),
                ],
            ])
            ->add('password', 'password', [
                'label'      => trans('core/acl::users.password'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'data-counter' => 60,
                ],
            ])
            ->add('password_confirmation', 'password', [
                'label'      => trans('core/acl::users.password_confirmation'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'data-counter' => 60,
                ],
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
            ])
            ->add('position_id', 'select', [
                'label' => __('Chức danh'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'class' => 'form-control select-search-full',
                ],
                'choices' => $catalogPosition,
            ]);
    }
}
