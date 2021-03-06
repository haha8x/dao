<?php

namespace Botble\Catalog\Models;

use Botble\Base\Models\BaseModel;

class CatalogZone extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'catalog_zones';

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'code',
        'name',
    ];
}
