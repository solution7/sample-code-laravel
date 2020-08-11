<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
use App\Models\Invoice;

class CustomerAddress extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $dates = ['deleted_at'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function invoice()
    {
        return $this->hasOne(\App\Models\Invoice::class, 'customer_address_id', 'id');
    }

    public static function deleteCustomerAddressReleted($customer_id)
    {
        $customerAddress = self::where('customer_id', $customer_id)->get();
        if ($customerAddress->count() > 0) {
            foreach ($customerAddress as $address) {
                Invoice::where('customer_address_id', $address->id)->delete();
            }
            return true;
        }
        return false;
    }

    public function country()
    {
        return $this->belongsTo(\App\Models\Country::class, 'address_country_id');
    }
}
