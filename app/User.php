<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Notifications\ResetPassword;
use App\Models\AbstractModel;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use App\Scopes\ProfileScope;

class User extends AbstractModel implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use HasApiTokens, Notifiable, SoftDeletes,
    Authenticatable, Authorizable, CanResetPassword;

    protected $dates = ['deleted_at'];

    protected $appends = ['profile'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'activated', 'activation_token'
    ];

    public static $DISABLED_OBSERVER = false;
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'activation_token'
    ];

    const ADMINISTRATOR_PERMISSION_ID = 1;
    const CLIENT_PERMISSION_ID = 2;
    const ACCOUNT_ADMINISTRATOR_PERMISSION_ID = 3;
    const PROJECT_ADMINISTRATOR_PERMISSION_ID = 4;
    const PROJECT_CLIENT_PERMISSION_ID = 5;

    const UNVERIFIED = 0;
    const VERIFIED = 1;


    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new ProfileScope);
    }

    public function userProfile()
    {
        return $this->hasOne(\App\Models\UserProfile::class);
    }

    public function files()
    {
        return $this->hasMany(\App\Models\File::class)->where('file_type_id', 1);
    }

    public function userPermission()
    {
        return $this->hasMany(\App\Models\UserPermission::class);
    }

    public function checkUserPermission($permissionTypeId)
    {
        return $this->userPermission->where('user_permission_type_id', $permissionTypeId)->first();
    }

    public function isClient()
    {
        return $this->checkUserPermission(self::CLIENT_PERMISSION_ID);
    }

    public function isAdmin()
    {
        return $this->checkUserPermission(self::ADMINISTRATOR_PERMISSION_ID);
    }

    public function isAccountAdministrator()
    {
        return $this->checkUserPermission(self::ACCOUNT_ADMINISTRATOR_PERMISSION_ID);
    }

    public function isProjectAdministrator()
    {
        return $this->checkUserPermission(self::PROJECT_ADMINISTRATOR_PERMISSION_ID);
    }

    public function profiles()
    {
        return $this->hasManyThrough(
            \App\Models\Profile::class,
            \App\Models\UserProfile::class,
            'user_id',
            'id',
            'id',
            'profile_id'
        );
    }

    public function profile()
    {
        return $this->profiles()->first();
    }

    public function getProfileAttribute()
    {
        return $this->profile();
    }

    public function getUserInfoAttribute()
    {
        $profile = $this->getProfileAttribute();
        if ($profile) {
            $profile->makeHidden([
                'confirmed_by_user_id',
                'confirmed_at',
                'bic',
                'iban',
                'language_id',
                'tax_key_id',
                'profession_id',
                'type',
                'updated_at',
                'addressCountry'
            ]);
        }
        return $profile;
    }

    public function hideUserExtraField()
    {
        $this->makeHidden(['activated', 'updated_at', 'deleted_at', 'created_at', 'id', 'email']);
    }

    public function scopeVerified($query)
    {
        return $query->where('activated', self::VERIFIED);
    }

    public function scopeUnverified($query)
    {
        return $query->where('activated', self::UNVERIFIED);
    }

    public function scopeAdministrator($query)
    {
        return $query->whereHas('userPermission', function ($q) {
            $q->whereIn('user_permission_type_id', [
              self::ACCOUNT_ADMINISTRATOR_PERMISSION_ID,
              self::PROJECT_ADMINISTRATOR_PERMISSION_ID
            ]);
        });
    }

    public function scopeProjectAdministrator($query)
    {
        return $query->whereHas('userPermission', function ($q) {
            $q->where('user_permission_type_id', self::PROJECT_ADMINISTRATOR_PERMISSION_ID);
        });
    }

    public function scopeAccountAdministrator($query)
    {
        return $query->whereHas('userPermission', function ($q) {
            $q->where('user_permission_type_id', self::ACCOUNT_ADMINISTRATOR_PERMISSION_ID);
        });
    }

    public function scopeClient($query)
    {
        return $query->whereHas('userPermission', function ($q) {
            $q->where('user_permission_type_id', self::CLIENT_PERMISSION_ID);
        });
    }
}
