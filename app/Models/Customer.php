<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\CountryScope;
use Auth;

class Customer extends Model
{
    use SoftDeletes;

    const DEFAULT_DUE_DAYS = 30;
    const USERS_CUSTOMER = 1;
    const ADMINISTRATORS_CUSTOMER = 2;

    protected $guarded = [];
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at', 'updated_at'];

    protected $appends = [
      'reference',
      'country',
      'customer_address_type_id',
      'address_country_id',
      'express_payment_enabled',
      'invoice_language_id',
    ];
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

    public function country()
    {
        return $this->belongsTo(\App\Models\Country::class);
    }

    public function profile()
    {
        return $this->belongsTo(\App\Models\Profile::class);
    }

    public function userProfile()
    {
        return $this->hasOne(\App\Models\UserProfile::class, 'profile_id', 'profile_id');
    }


    public function addresses()
    {
        return $this->hasMany(\App\Models\CustomerAddress::class);
    }

    public function address()
    {
        return $this->addresses()->withTrashed()
            ->orderBy('updated_at', 'desc')
            ->first();
    }

    public function orders()
    {
        return $this->hasMany(\App\Models\Order::class);
    }

    public function getReferenceAttribute()
    {
        return $this->attributes['reference'] = optional($this->address())->reference;
    }

    public function getCountryAttribute()
    {
        return  $this->attributes['country'] = $this->address()->country->name ?? SITE_COUNTRY_NAME;
    }

    public function getCustomerAddressTypeIdAttribute()
    {
        return $this->attributes['reference'] = optional($this->address())->customer_address_type_id;
    }

    public function getInvoiceLanguageIdAttribute()
    {
        return $this->attributes['invoice_language_id'] = optional($this->address())->invoice_language_id;
    }

    public function getAddressCountryIdAttribute()
    {
        return  $this->attributes['address_country_id'] = $this->address()->address_country_id ?? SYSTEM_COUNTRY_ID;
    }

    public function getExpressPaymentEnabledAttribute()
    {
        return  $this->attributes['express_payment_enabled'] =
          ($this->country_id === SYSTEM_COUNTRY_ID) ? CountrySetting::getOne('EXPRESS_PAYMENT_ENABLED') : '';
    }

    public function scopeSearch($query, $request)
    {
        return $query->where(function ($q) use ($request) {
              $q->where('name', 'like', '%'.$request->q.'%')
              ->orWhere('vat_number', 'like', '%'.$request->q.'%')
              ->orWhere('city', 'like', '%'.$request->q.'%')
              ->orWhere('id', 'like', '%'.$request->q.'%');
        });
    }

    public function scopeUsersCustomer($query)
    {
        return $query->where('customer_type_id', self::USERS_CUSTOMER);
    }
}
