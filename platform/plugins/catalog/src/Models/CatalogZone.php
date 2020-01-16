<?php

namespace Botble\Catalog\Models;

use Botble\Base\Traits\EnumCastable;
use Botble\Base\Models\BaseModel;

class CatalogZone extends BaseModel
{
    use EnumCastable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'catalog_zones';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
    ];
}
