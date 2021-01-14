<?php

namespace Botble\ACL\Models;

use Botble\ACL\Models\ZoneBranchPivot;
use Botble\ACL\Notifications\ResetPasswordNotification;
use Botble\ACL\Traits\PermissionTrait;
use Botble\Base\Supports\Avatar;
use Botble\Catalog\Models\CatalogBranch;
use Botble\Media\Models\MediaFile;
use Exception;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Storage;
use Botble\Catalog\Models\CatalogPosition;
use Botble\Catalog\Models\CatalogZone;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Botble\Hr\Enums\UserTitleEnum;

class User extends Authenticatable
{
    use PermissionTrait;
    use Notifiable;

    /**
     * {@inheritDoc}
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'name',
        'password',
        'super_user',
        'avatar_id',
        'permissions',
        'title',
        'dao',
        'staff_id',
        'note',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The date fields for the model.clear
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'permissions' => 'json',
        // 'title' => UserTitleEnum::class,
    ];

    /**
     * @return BelongsToMany
     */
    public function positions(): BelongsToMany
    {
        return $this->belongsToMany(CatalogPosition::class, 'user_positions', 'user_id', 'position_id');
    }

    public function zones(): BelongsToMany
    {
        return $this->belongsToMany(CatalogZone::class, 'user_positions', 'user_id', 'zone_id');
    }

    public function branchs(): BelongsToMany
    {
        return $this->belongsToMany(CatalogBranch::class, 'user_positions', 'user_id', 'branch_id');
    }

    /**
     * @return string
     */
    public function getPosition()
    {
        try {
            return $this->positions;
        } catch (Exception $exception) {
            return null;
        }
    }

    public function getZone()
    {
        try {
            return $this->zones;
        } catch (Exception $exception) {
            return null;
        }
    }

    public function getBranch()
    {
        try {
            return $this->branchs;
        } catch (Exception $exception) {
            return null;
        }
    }

    /**
     * Always capitalize the first name when we retrieve it
     * @param string $value
     * @return string
     */
    public function getFirstNameAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * Always capitalize the last name when we retrieve it
     * @param string $value
     * @return string
     */
    public function getLastNameAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return ucfirst($this->name);
    }

    /**
     * @return BelongsTo
     */
    public function avatar()
    {
        return $this->belongsTo(MediaFile::class)->withDefault();
    }

    /**
     * @return UrlGenerator|string
     */
    public function getAvatarUrlAttribute()
    {
        return $this->avatar->url ? Storage::url($this->avatar->url) : (new Avatar)->create($this->getFullName())->toBase64();
    }

    /**
     * @param string $value
     * @return array
     */
    public function getPermissionsAttribute($value)
    {
        try {
            return json_decode($value, true) ?: [];
        } catch (Exception $exception) {
            return [];
        }
    }

    /**
     * Set mutator for the "permissions" attribute.
     *
     * @param array $permissions
     * @return void
     */
    public function setPermissionsAttribute(array $permissions)
    {
        $this->attributes['permissions'] = $permissions ? json_encode($permissions) : '';
    }

    /**
     * @return BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_users', 'user_id', 'role_id')->withTimestamps();
    }

    /**
     * @return boolean
     */
    public function isSuperUser()
    {
        return $this->super_user || $this->hasAccess(ACL_ROLE_SUPER_USER);
    }

    /**
     * @param string $permission
     * @return boolean
     */
    public function hasPermission($permission)
    {
        if ($this->isSuperUser()) {
            return true;
        }

        return $this->hasAccess($permission);
    }

    /**
     * @param array $permissions
     * @return bool
     */
    public function hasAnyPermission(array $permissions)
    {
        if ($this->isSuperUser()) {
            return true;
        }

        return $this->hasAnyAccess($permissions);
    }

    /**
     * @return array
     */
    public function authorAttributes()
    {
        return [
            'name'   => $this->getFullName(),
            'email'  => $this->email,
            'url'    => $this->website,
            'avatar' => $this->avatar_url,
        ];
    }

    /**
     * Send the password reset notification.
     *
     * @param string $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * Returns the activations relationship.
     *
     * @return HasMany
     */
    public function activations()
    {
        return $this->hasMany(Activation::class, 'user_id');
    }

    /**
     * {@inheritDoc}
     */
    public function inRole($role)
    {
        $roleId = null;
        if ($role instanceof Role) {
            $roleId = $role->getKey();
        }

        foreach ($this->roles as $instance) {
            /**
             * @var Role $instance
             */
            if ($role instanceof Role) {
                if ($instance->getKey() === $roleId) {
                    return true;
                }
            } elseif ($instance->getKey() == $role || $instance->slug == $role) {
                return true;
            }
        }

        return false;
    }

    /**
     * {@inheritDoc}
     */
    public function delete()
    {
        if ($this->exists) {
            $this->activations()->delete();
            $this->roles()->detach();
        }

        return parent::delete();
    }
}
