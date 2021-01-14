<?php

namespace Botble\Hr\Enums;

use Botble\Base\Supports\Enum;
use Html;

/**
 * @method static RequestStatusEnum TAODAO()
 * @method static RequestStatusEnum TIEPNHANYEUCAU()
 */
class UserTitleEnum extends Enum
{
    public const CHINH_THUC = 'chinh_thuc';
    public const CONG_TAC_VIEN = 'cong_tac_vien';

    /**
     * @var string
     */
    public static $langPath = 'packages/hr::hr.statuses';

    /**
     * @return string
     */
    public function toHtml()
    {
        switch ($this->value) {
            case self::CHINH_THUC:
                return Html::tag('span', self::CHINH_THUC()->label(), ['class' => 'label-default status-label'])
                    ->toHtml();
            case self::CONG_TAC_VIEN:
                return Html::tag('span', self::CONG_TAC_VIEN()->label(), ['class' => 'label-warning status-label'])
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
            case self::CHINH_THUC:
                return self::CHINH_THUC()->label();
            case self::CONG_TAC_VIEN:
                return self::CONG_TAC_VIEN()->label();
            default:
                return null;
        }
    }
}
