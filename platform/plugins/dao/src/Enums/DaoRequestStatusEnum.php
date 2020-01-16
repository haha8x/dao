<?php

namespace Botble\Dao\Enums;

use Botble\Base\Supports\Enum;
use Html;

/**
 * @method static DaoRequestStatusEnum TAODAO()
 * @method static DaoRequestStatusEnum TIEPNHANYEUCAU()
 */
class DaoRequestStatusEnum extends Enum
{
    public const CREATE = 'create';
    public const RECEIVE = 'receive';
    public const REJECT = 'reject';
    public const IT_PROCESS = 'it_process';
    public const GDCN_APPROVE = 'gdcn_approve';
    public const HOISO_APPROVE = 'hoiso_approve';
    public const SUCCESS = 'success';

    /**
     * @var string
     */
    public static $langPath = 'plugins/dao::dao-request.statuses';

    /**
     * @return string
     */
    public function toHtml()
    {
        switch ($this->value) {
            case self::CREATE:
                return Html::tag('span', self::CREATE()->label(), ['class' => 'label-default status-label'])
                    ->toHtml();
            case self::RECEIVE:
                return Html::tag('span', self::RECEIVE()->label(), ['class' => 'label-warning status-label'])
                    ->toHtml();
            case self::REJECT:
                return Html::tag('span', self::REJECT()->label(), ['class' => 'label-danger status-label'])
                    ->toHtml();
            case self::IT_PROCESS:
                return Html::tag('span', self::IT_PROCESS()->label(), ['class' => 'label-info status-label'])
                    ->toHtml();
            case self::GDCN_APPROVE:
                return Html::tag('span', self::GDCN_APPROVE()->label(), ['class' => 'label-light status-label'])
                    ->toHtml();
            case self::HOISO_APPROVE:
                return Html::tag('span', self::HOISO_APPROVE()->label(), ['class' => 'label-primary status-label'])
                    ->toHtml();
            case self::SUCCESS:
                return Html::tag('span', self::SUCCESS()->label(), ['class' => 'label-success status-label'])
                    ->toHtml();
            default:
                return null;
        }
    }
}
