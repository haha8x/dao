<?php

use Botble\Dao\Enums\TransferTypeEnum;

return [
    'name'   => 'Yêu cầu chuyển mã DAO',
    'create' => 'Tạo Yêu cầu chuyển mã DAO',
    'edit'   => 'Sửa Yêu cầu chuyển mã DAO',
    'types' => [
        TransferTypeEnum::PB_DAO => 'PB DAO',
        TransferTypeEnum::DAO_CIF => 'DAO CIF',
        TransferTypeEnum::LD => 'LD - Hợp đồng khoản vay',
        TransferTypeEnum::STK => 'Số tài khoản - Huy động tăng ròng',
        TransferTypeEnum::AL => 'AL - HĐ thẻ tín dụng',
        TransferTypeEnum::MD => 'MD - Hợp đồng trái phiếu',
    ],
];
