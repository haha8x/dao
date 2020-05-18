<?php

namespace Botble\Catalog\Models;

use Botble\Base\Traits\EnumCastable;
use Botble\Base\Models\BaseModel;

class CatalogPosition extends BaseModel
{
    use EnumCastable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'catalog_positions';

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
    ];
}
