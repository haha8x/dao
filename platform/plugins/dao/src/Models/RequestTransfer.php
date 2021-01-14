<?php

namespace Botble\Dao\Models;

use Botble\ACL\Models\User;
use Botble\Base\Traits\EnumCastable;
use Botble\Dao\Enums\RequestStatusEnum;
use Botble\Base\Models\BaseModel;
use Botble\Dao\Enums\TransferTypeEnum;
use Botble\Catalog\Models\CatalogBranch;
use Botble\Catalog\Models\CatalogPosition;
use Botble\Catalog\Models\CatalogZone;
use Botble\Customer\Models\Customer;

class RequestTransfer extends BaseModel
{
    use EnumCastable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'request_transfers';

    /**
     * @var array
     */
    protected $fillable = [
        'type',
        'zone_id',
        'branch_id',
        'acct_no',
        'staff_name',
        'email',
        'customer_id',
        'ref_no',
        'dao_old',
        'dao_transfer',
        'reason',
        'status',
        'note',
        'created_by',
        'updated_by',

    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'status' => RequestStatusEnum::class,
        'type' => TransferTypeEnum::class,
    ];
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by')->withDefault();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * 
     */
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by')->withDefault();
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
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
