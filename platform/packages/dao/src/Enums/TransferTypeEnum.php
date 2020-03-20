<?php

namespace Botble\Dao\Enums;

use Botble\Base\Supports\Enum;
use Html;

/**
 * @method static TransferTypeEnum PB_DAO()
 * @method static TransferTypeEnum DAO_CIF()
 */
class TransferTypeEnum extends Enum
{
    public const PB_DAO = 'pb_dao';
    public const DAO_CIF = 'dao_cif';
    public const LD = 'ld';
    public const STK = 'stk';
    public const AL = 'al';
    public const MD = 'md';

    /**
     * @var string
     */
    public static $langPath = 'packages/dao::request-transfer.types';

    /**
     * @return string
     */
    public function toHtml()
    {
        switch ($this->value) {
            case self::PB_DAO:
                return Html::tag('span', self::PB_DAO()->label(), ['class' => 'label-default status-label'])
                    ->toHtml();
            case self::DAO_CIF:
                return Html::tag('span', self::DAO_CIF()->label(), ['class' => 'label-warning status-label'])
                    ->toHtml();
            case self::LD:
                return Html::tag('span', self::LD()->label(), ['class' => 'label-danger status-label'])
                    ->toHtml();
            case self::STK:
                return Html::tag('span', self::STK()->label(), ['class' => 'label-info status-label'])
                    ->toHtml();
            case self::AL:
                return Html::tag('span', self::AL()->label(), ['class' => 'label-primary status-label'])
                    ->toHtml();
            case self::MD:
                return Html::tag('span', self::MD()->label(), ['class' => 'label-primary status-label'])
                    ->toHtml();
            default:
                return null;
        }
    }

        /**
     * @return string
     */
    public function toText()
    {
        switch ($this->value) {
            case self::PB_DAO:
                return self::PB_DAO()->label();
            case self::DAO_CIF:
                return self::DAO_CIF()->label();
            case self::LD:
                return self::LD()->label();
            case self::STK:
                return self::STK()->label();
            case self::AL:
                return self::AL()->label();
            case self::MD:
                return self::MD()->label();
            default:
                return null;
        }
    }
}
