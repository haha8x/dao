<?php

namespace Botble\Catalog\Models;

use Botble\Base\Traits\EnumCastable;
use Botble\Base\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CatalogBranch extends BaseModel
{
    use EnumCastable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'catalog_branches';

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'zone_id',
        'code',
        'name',
    ];

    /**
     * @return BelongsTo
     */
    public function zone()
    {
        return $this->belongsTo(CatalogZone::class)->withDefault();
    }
}
