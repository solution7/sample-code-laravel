<?php

namespace App\Models;

use App\User;
use App\Models\Order;
use App\Models\CustomerAddress;
use App\Models\UserProfile;
use App\Models\UserPermission;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\CountryScope;

class Profile extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $dates = ['deleted_at'];
    protected $hidden = ['deleted_at', 'confirmed_at', 'updated_at', 'created_at', 'addressCountry'];
    protected $appends = ['country', 'email'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new CountryScope);
    }

    public function userProfile()
    {
        return $this->hasOne(\App\Models\UserProfile::class);
    }

    public function customers()
    {
        return $this->hasMany(\App\Models\Customer::class);
    }

    public function comments()
    {
        return $this->hasMany(\App\Models\ProfileComment::class);
    }

    public function agreements()
    {
        return $this->hasMany(\App\Models\Agreement::class);
    }

    public function deleteAllRelative()
    {
        $user_id = $this->userProfile->user_id;

        if ($this->customers->count() > 0) {
            foreach ($this->customers as $customer) {
                $orders = Order::deleteOrderReleted($customer->id);
                $customerAddress = CustomerAddress::deleteCustomerAddressReleted($customer->id);
                Order::where('customer_id', $customer->id)->delete();
                CustomerAddress::where('customer_id', $customer->id)->delete();
            }
            $this->customers->delete();
        }

        if ($this->comments->count() > 0) {
            $this->comments->delete();
        }

        if ($this->userProfile->count() > 0) {
            $this->userProfile->delete();
        }

        $user = User::find($user_id);
        if ($user->files->count() > 0) {
            $user->files->delete();
        }

        UserPermission::where('user_id', $user_id)->delete();
    }

    public function getProfileLanguageId()
    {
        if (!empty($this->language_id)) {
            return $this->language_id;
        }

        return CountrySetting::getOne('DEFAULT_LANGUAGE_ID');
    }

    public function taxKey()
    {
        return $this->belongsTo(\App\Models\TaxKey::class);
    }

    public function addressCountry()
    {
        return $this->belongsTo(\App\Models\Country::class, 'address_country_id');
    }

    public function getCountryAttribute()
    {
        return optional($this->addressCountry)->name;
    }

    public function getEmailAttribute()
    {
        $user = User::find($this->userProfile->user_id);
        return optional($user)->email;
    }

    public function profession()
    {
        return $this->belongsTo(\App\Models\Profession::class);
    }

    public function notifications()
    {
        return $this->hasMany(\App\Models\NotificationSetting::class);
    }
}
