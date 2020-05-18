<?php

namespace Botble\Dao\Enums;

use Botble\Base\Supports\Enum;
use Html;

/**
 * @method static RequestStatusEnum TAODAO()
 * @method static RequestStatusEnum TIEPNHANYEUCAU()
 */
class RequestStatusEnum extends Enum
{
    public const TAO_MOI = 'tao_moi';
    public const TIEP_NHAN = 'tiep_nhan';
    public const TU_CHOI = 'tu_choi';
    public const IT_XULY = 'it_xyly';
    public const GDCN_DUYET = 'gdcn_duyet';
    public const HOISO_DUYET = 'hoiso_duyet';
    public const TPKH_DUYET = 'tpkh_duyet';
    public const THANH_CONG = 'thanh_cong';

    /**
     * @var string
     */
    public static $langPath = 'plugins/dao::dao.statuses';

    /**
     * @return string
     */
    public function toHtml()
    {
        switch ($this->value) {
            case self::TAO_MOI:
                return Html::tag('span', self::TAO_MOI()->label(), ['class' => 'label-default status-label'])
                    ->toHtml();
            case self::TIEP_NHAN:
                return Html::tag('span', self::TIEP_NHAN()->label(), ['class' => 'label-warning status-label'])
                    ->toHtml();
            case self::TU_CHOI:
                return Html::tag('span', self::TU_CHOI()->label(), ['class' => 'label-danger status-label'])
                    ->toHtml();
            case self::IT_XULY:
                return Html::tag('span', self::IT_XULY()->label(), ['class' => 'label-info status-label'])
                    ->toHtml();
            case self::GDCN_DUYET:
                return Html::tag('span', self::GDCN_DUYET()->label(), ['class' => 'label-primary status-label'])
                    ->toHtml();
            case self::HOISO_DUYET:
                return Html::tag('span', self::HOISO_DUYET()->label(), ['class' => 'label-primary status-label'])
                    ->toHtml();
            case self::THANH_CONG:
                return Html::tag('span', self::THANH_CONG()->label(), ['class' => 'label-success status-label'])
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
            case self::TAO_MOI:
                return self::TAO_MOI()->label();
            case self::TIEP_NHAN:
                return self::TIEP_NHAN()->label();
            case self::TU_CHOI:
                return self::TU_CHOI()->label();
            case self::IT_XULY:
                return self::IT_XULY()->label();
            case self::GDCN_DUYET:
                return self::GDCN_DUYET()->label();
            case self::HOISO_DUYET:
                return self::HOISO_DUYET()->label();
            case self::THANH_CONG:
                return self::THANH_CONG()->label();
            default:
                return null;
        }
    }
}
