<?php

use Botble\Dao\Enums\RequestStatusEnum;

return [
    'name' => 'Dao',
    'create' => 'New dao',
    'edit' => 'Edit dao',
    'statuses' => [
        RequestStatusEnum::TAO_MOI => 'Tạo mới',
        RequestStatusEnum::TIEP_NHAN => 'Tiếp nhận',
        RequestStatusEnum::TU_CHOI => 'Từ chối',
        RequestStatusEnum::IT_XULY => 'IT Xử lý',
        RequestStatusEnum::GDCN_DUYET => 'GDCN Duyệt',
        RequestStatusEnum::HOISO_DUYET => 'Hội sở Duyệt',
        RequestStatusEnum::TPKH_DUYET => 'TPKH Duyệt',
        RequestStatusEnum::THANH_CONG => 'Thành công',
    ],
];