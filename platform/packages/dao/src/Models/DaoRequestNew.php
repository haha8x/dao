<?php

namespace Botble\Dao\Models;

use Botble\Base\Traits\EnumCastable;
use Botble\Dao\Enums\DaoRequestStatusEnum;
use Botble\Base\Models\BaseModel;
use Botble\Catalog\Models\CatalogBranch;
use Botble\Catalog\Models\CatalogPosition;
use Botble\Catalog\Models\CatalogZone;

class DaoRequestNew extends BaseModel
{
    use EnumCastable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'dao_request_news';

    /**
     * @var array
     */
    protected $fillable = [
        'zone_id',
        'branch_id',
        'staff_id',
        'staff_name',
        'position_id',
        'level',
        'cif',
        'email',
        'cmnd',
        'phone',
        'decision_file',
        'status',
        'note',
        'updated_by',

    ];

    /**
     * @var array
     */
    protected $casts = [
        'status' => DaoRequestStatusEnum::class,
    ];

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
