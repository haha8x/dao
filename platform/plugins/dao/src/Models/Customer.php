<?php

namespace Botble\Dao\Models;

use Botble\Base\Traits\EnumCastable;
use Botble\Base\Models\BaseModel;
use Botble\Catalog\Models\CatalogBranch;
use Botble\Catalog\Models\CatalogPosition;
use Botble\Catalog\Models\CatalogZone;

class Customer extends BaseModel
{
    use EnumCastable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customers';

    /**
     * @var array
     */
    protected $fillable = [
        'acct_no',
        'cif',
        'customer_name',
        'product_name',
        'branch_id',
        'dao',
        'open_date',
        'staff_id',
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
