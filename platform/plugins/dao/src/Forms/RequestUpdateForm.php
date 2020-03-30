<?php

namespace Botble\Dao\Forms;

use Botble\Base\Forms\FormAbstract;
use Botble\Dao\Http\Requests\RequestUpdateRequest;
use Botble\Dao\Models\RequestUpdate;
use Botble\Catalog\Repositories\Interfaces\CatalogBranchInterface;
use Botble\Catalog\Repositories\Interfaces\CatalogPositionInterface;
use Botble\Catalog\Repositories\Interfaces\CatalogZoneInterface;
use Assets;
use Botble\Dao\Enums\RequestStatusEnum;

class RequestUpdateForm extends FormAbstract
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
        Assets::addScriptsDirectly('vendor/core/plugins/dao/js/dao.js')
            ->addStyles(['datetimepicker']);

        Assets::addScriptsDirectly('vendor/core/plugins/catalog/js/catalog.js');

        $catalogBranch = $this->catalogBranchRepository->pluck('catalog_branches.name', 'catalog_branches.id');
        $catalogZone = $this->catalogZoneRepository->pluck('catalog_zones.name', 'catalog_zones.id');
        $catalogPosition = $this->catalogPositionRepository->pluck('catalog_positions.name', 'catalog_positions.id');

        $this
            ->setupModel(new RequestUpdate)
            ->setValidatorClass(RequestUpdateRequest::class)
            ->add('dao_old', 'text', [
                'label'      => __('DAO cũ'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => __('Nhập tên DAO'),
                    'data-counter' => 120,
                ],
            ])
            ->add('dao_update', 'text', [
                'label'      => __('DAO mới'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => __('Nhập tên DAO'),
                    'data-counter' => 120,
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
                ],
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
            ->add('from_date', 'text', [
                'label' => __('Ngày cấp DAO'),
                'label_attr' => ['class' => 'control-label required'],
                'attr' => [
                    'data-counter' => 30,
                    'class' => 'form-control datepicker',
                    'data-date-format' => config('core.base.general.date_format.js.date'),
                ],
            ])
            ->add('to_date', 'text', [
                'label' => __('Ngày hết hạn DAO'),
                'label_attr' => ['class' => 'control-label'],
                'attr' => [
                    'data-counter' => 30,
                    'class' => 'form-control datepicker',
                    'data-date-format' => config('core.base.general.date_format.js.date'),
                ],
            ])
            ->add('email', 'text', [
                'label'      => __('Email'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => __('Nhập địa chỉ email'),
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
            ->add('note', 'textarea', [
                'label' => __('Note'),
                'label_attr' => ['class' => 'control-label'],
                'attr' => [
                    'data-counter' => 255,
                    'rows' => 4,
                ],
            ])
            ->add('dao_status', 'text', [
                'label'      => __('Trạng thái DAO'),
                'label_attr' => ['class' => 'control-label'],
                'value'      => 60,
                'attr'       => [
                    'readonly' => true,
                ],
            ])
            ->setBreakFieldPoint('note');
    }
}
