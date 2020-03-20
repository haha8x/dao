<?php

use Botble\Dao\Enums\TransferTypeEnum;

return [
    'name'   => 'Yêu cầu chuyển mã DAO',
    'create' => 'Tạo Yêu cầu chuyển mã DAO',
    'edit'   => 'Sửa Yêu cầu chuyển mã DAO',
    'types' => [
        TransferTypeEnum::PB_DAO => 'PB DAO',
        TransferTypeEnum::DAO_CIF => 'DAO CIF',
        TransferTypeEnum::LD => 'LD',
        TransferTypeEnum::STK => 'STK',
        TransferTypeEnum::AL => 'AL',
        TransferTypeEnum::MD => 'MD',
    ],
];

