<?php

namespace Botble\Dao\Forms;

use Botble\Base\Forms\FormAbstract;
use Botble\Dao\Http\Requests\DaoRequestCloseRequest;
use Botble\Dao\Models\DaoRequestClose;

class DaoRequestCloseForm extends FormAbstract
{

    /**
     * @return mixed|void
     * @throws \Throwable
     */
    public function buildForm()
    {
        $this
            ->setupModel(new DaoRequestClose)
            ->setValidatorClass(DaoRequestCloseRequest::class)
            ->add('dao', 'text', [
                'label'      => __('DAO cần đóng'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => __('Nhập DAO'),
                    'data-counter' => 120,
                ],
            ])
            ->add('zone_id', 'select', [
                'label' => __('Vùng'),
                'label_attr' => ['class' => 'control-label required'],
                'choices' => [
                    1 => __('Vùng 1'),
                    2 => __('Vùng 2'),
                    3 => __('Vùng 3'),
                    4 => __('Vùng 4'),
                    5 => __('Vùng 5'),
                    6 => __('Vùng 6'),
                    7 => __('Vùng 7'),
                    8 => __('Vùng 8'),
                    9 => __('Vùng 9'),
                    10 => __('Vùng 10'),
                    11 => __('Vùng 11'),
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
            ->add('name', 'text', [
                'label'      => __('Họ tên CBBH'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => __('Nhập tên đúng, in hoa, không dấu'),
                    'data-counter' => 120,
                ],
            ])
            ->add('chuc_danh', 'select', [
                'label' => __('Chức danh'),
                'label_attr' => ['class' => 'control-label required'],
                'choices' => [
                    'PB' => __('PB'),
                    'RB' => __('RB'),
                ],
            ])
            ->add('status_dao', 'text', [
                'label'      => __('Trạng thái DAO'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => __('70'),
                    'data-counter' => 120,
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
            ->add('date_issue', 'date', [
                'label' => __('Ngày cấp DAO'),
                'label_attr' => ['class' => 'control-label'],
            ])
            ->add('date_expired', 'date', [
                'label' => __('Ngày hết hạn DAO'),
                'label_attr' => ['class' => 'control-label'],
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
            ;
    }
}
