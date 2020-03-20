<?php

namespace Botble\Dao\Models;

use Botble\Base\Traits\EnumCastable;
use Botble\Dao\Enums\RequestStatusEnum;
use Botble\Base\Models\BaseModel;

class DaoRequestClose extends BaseModel
{
    use EnumCastable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'dao_request_closes';

    /**
     * @var array
     */
    protected $fillable = [
        'dao_id',
        'status',
        'note',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'status' => RequestStatusEnum::class,
    ];

    /**
     * @return BelongsTo
     */
    public function dao()
    {
        return $this->belongsTo(Dao::class);
    }
}
