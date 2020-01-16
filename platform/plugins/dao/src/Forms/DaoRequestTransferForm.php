<?php

namespace Botble\Dao\Forms;

use Botble\Base\Forms\FormAbstract;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Dao\Http\Requests\DaoRequestTransferRequest;
use Botble\Dao\Models\DaoRequestTransfer;

class DaoRequestTransferForm extends FormAbstract
{

    /**
     * @return mixed|void
     * @throws \Throwable
     */
    public function buildForm()
    {
        $this
            ->setupModel(new DaoRequestTransfer)
            ->setValidatorClass(DaoRequestTransferRequest::class)
            ->add('dao_transfer_type', 'select', [
                'label' => __('Yêu cầu'),
                'label_attr' => ['class' => 'control-label required'],
                'choices' => [
                    'PB-DAO' => __('Đổi PB DAO'),
                    'SP-DAO' => __('Đổi DAO Sản phẩm'),
                ],
            ])
            ->add('branch_code', 'text', [
                'label'      => __('Chi nhánh'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => __('Nhập tên mã nhánh đúng (VD VN001234)'),
                    'data-counter' => 120,
                ],
            ])
            ->add('acctno', 'text', [
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
            ->add('dao', 'text', [
                'label'      => __('DAO cũ'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => __('Nhập tên DAO'),
                    'data-counter' => 120,
                ],
            ])
            ->add('dao_transfer', 'text', [
                'label'      => __('DAO mới'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => __('Nhập tên DAO'),
                    'data-counter' => 120,
                ],
            ])
            ->add('note_transfer', 'select', [
                'label' => __('Lý do'),
                'label_attr' => ['class' => 'control-label'],
                'choices' => [
                    'Do phân bổ lại CB quản lý KH' => __('Do phân bổ lại CB quản lý KH'),
                    'Do CBBH nghỉ việc/buộc thôi việc/điều chuyển sang bộ phận khác' => __('Do CBBH nghỉ việc/buộc thôi việc/điều chuyển sang bộ phận khác'),
                    'Khác' => __('Khác'),
                ],
            ])
            ->add('note_sale', 'text', [
                'label'      => __('Note (Nếu chọn lý do khác)'),
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'placeholder'  => __('Nhập lý do khác'),
                    'data-counter' => 120,
                ],
            ])
            ->add('request_type', 'hidden', [
                'value'      => 'transfer',
            ])
            ;
    }
}
