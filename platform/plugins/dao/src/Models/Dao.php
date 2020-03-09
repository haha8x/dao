<?php

namespace Botble\Dao\Models;

use Botble\Base\Models\BaseModel;
use Botble\Catalog\Models\CatalogBranch;
use Botble\Catalog\Models\CatalogPosition;
use Botble\Catalog\Models\CatalogZone;

class Dao extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'daos';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'status',
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
