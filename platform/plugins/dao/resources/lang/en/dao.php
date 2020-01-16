<?php

use Botble\Dao\Enums\DaoRequestStatusEnum;

return [
    'name' => 'Danh sách DAO',
    'statuses' => [
        DaoRequestStatusEnum::CREATE => 'Tạo mới',
        DaoRequestStatusEnum::RECEIVE => 'Tiếp nhận',
        DaoRequestStatusEnum::REJECT => 'Từ chối',
        DaoRequestStatusEnum::IT_PROCESS => 'IT xử lý',
        DaoRequestStatusEnum::GDCN_APPROVE => 'Giám đốc chi nhánh duyệt',
        DaoRequestStatusEnum::HOISO_APPROVE => 'Hội sở duyệt',
        DaoRequestStatusEnum::SUCCESS => 'Thành công',
    ],
];
