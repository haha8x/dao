<?php

namespace Botble\Dao\Models;

use Botble\Base\Traits\EnumCastable;
use Botble\Dao\Enums\RequestStatusEnum;
use Botble\Base\Models\BaseModel;
use Botble\Dao\Enums\TransferTypeEnum;

class DaoRequestTransfer extends BaseModel
{
    use EnumCastable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'dao_request_transfers';

    /**
     * @var array
     */
    protected $fillable = [
        'type',
        'dao_id',
        'dao_transfer',
        'reason',
        'status',
        'note',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'status' => RequestStatusEnum::class,
        'type' => TransferTypeEnum::class,
    ];

        /**
     * @return BelongsTo
     */
    public function dao()
    {
        return $this->belongsTo(Dao::class);
    }
}
