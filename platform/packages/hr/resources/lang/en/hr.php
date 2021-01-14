<?php

use Botble\Hr\Enums\UserTitleEnum;

return [
    'name' => 'Quản lý nhân sự',
    'create' => 'Thêm mới nhân sự',
    'edit' => 'Sửa nhân sự',
    'statuses' => [
        UserTitleEnum::CHINH_THUC => 'Chính thức',
        UserTitleEnum::CONG_TAC_VIEN => 'Cộng tác viên',
    ],
];
