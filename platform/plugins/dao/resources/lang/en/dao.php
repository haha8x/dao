<?php

use Botble\Dao\Enums\RequestStatusEnum;

return [
    'name' => 'Danh sách DAO',
    'statuses' => [
        RequestStatusEnum::CREATE => 'Tạo mới',
        RequestStatusEnum::RECEIVE => 'Tiếp nhận',
        RequestStatusEnum::REJECT => 'Từ chối',
        RequestStatusEnum::IT_PROCESS => 'IT xử lý',
        RequestStatusEnum::GDCN_APPROVE => 'GDCN duyệt',
        RequestStatusEnum::HOISO_APPROVE => 'Hội sở duyệt',
        RequestStatusEnum::SUCCESS => 'Thành công',
    ],
];
