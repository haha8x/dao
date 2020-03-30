<?php

namespace Botble\Dao\Forms;

use Botble\Base\Forms\FormAbstract;
use Botble\Dao\Http\Requests\RequestTransferRequest;
use Botble\Dao\Models\RequestTransfer;
use Botble\Catalog\Repositories\Interfaces\CatalogBranchInterface;
use Botble\Catalog\Repositories\Interfaces\CatalogPositionInterface;
use Botble\Catalog\Repositories\Interfaces\CatalogZoneInterface;
use Assets;
use Botble\Dao\Enums\RequestStatusEnum;
use Botble\Dao\Enums\TransferTypeEnum;

class RequestTransferForm extends FormAbstract
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

        Assets::addScriptsDirectly('vendor/core/plugins/dao/js/dao.js');
        Assets::addScriptsDirectly('vendor/core/plugins/catalog/js/catalog.js');

        $catalogBranch = $this->catalogBranchRepository->pluck('catalog_branches.name', 'catalog_branches.id');
        $catalogZone = $this->catalogZoneRepository->pluck('catalog_zones.name', 'catalog_zones.id');
        $catalogPosition = $this->catalogPositionRepository->pluck('catalog_positions.name', 'catalog_positions.id');

        $this
            ->setupModel(new RequestTransfer)
            ->setValidatorClass(RequestTransferRequest::class)
            ->add('type', 'select', [
                'label' => __('Yêu cầu'),
                'label_attr' => ['class' => 'control-label required'],
                'choices'    => TransferTypeEnum::labels(),
            ])
            ->add('branch_id', 'select', [
                'label'      => __('Chi nhánh'),
                'label_attr' => ['class' => 'control-label required'],
                'choices' => $catalogBranch,
            ])
            ->add('acct_no', 'text', [
                'label'      => __('Acctno'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => __('Nhập mã HĐ'),
                    'data-counter' => 120,
                ],
            ])
            ->add('customer_name', 'text', [
                'label'      => __('Tên khách hàng'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => __('Nhập tên KH'),
                    'data-counter' => 120,
                ],
            ])
            ->add('cif', 'text', [
                'label'      => __('CIF'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => __('Nhập CIF'),
                    'data-counter' => 120,
                ],
                'wrapper' => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ($this->getModel() ? ' hidden' : null),
                ],
            ])
            ->add('dao_old', 'text', [
                'label'      => __('DAO cũ'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => __('Nhập DAO cũ'),
                    'data-counter' => 120,
                ],
            ])
            ->add('dao_transfer', 'text', [
                'label'      => __('DAO mới'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => __('Nhập DAO mới'),
                    'data-counter' => 120,
                ],
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
