<?php

namespace Botble\Dao\Models;

use Botble\Base\Traits\EnumCastable;
use Botble\Dao\Enums\RequestStatusEnum;
use Botble\Base\Models\BaseModel;

class DaoRequestUpdate extends BaseModel
{
    use EnumCastable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'dao_request_updates';

    /**
     * @var array
     */
    protected $fillable = [
        'dao_id',
        'dao_update',
        'zone_id',
        'branch_id',
        'staff_id',
        'name',
        'position_id',
        'cif',
        'email',
        'cmnd',
        'phone',
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

    /**
     * @return BelongsTo
     */
    public function zone()
    {
        return $this->belongsTo(CatalogZone::class);
    }

    /**
     * @return BelongsTo
     */
    public function branch()
    {
        return $this->belongsTo(CatalogBranch::class);
    }

    /**
     * @return BelongsTo
     */
    public function position()
    {
        return $this->belongsTo(CatalogPosition::class);
    }
}
