<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Invoice extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $dates = ['deleted_at'];
    protected $hidden = ['customers'];

    public function getCustomerNameAttribute()
    {
        return $this->customer()->name;
    }

    public function customer()
    {
        return $this->customers->first();
    }

    public function customers()
    {
        return $this->hasManyThrough(
            \App\Models\Customer::class,
            \App\Models\Order::class,
            'invoice_id',
            'id',
            'id',
            'customer_id'
        )->withTrashed();
    }

    public function order()
    {
        return $this->hasOne(\App\Models\Order::class)->withoutGlobalScope(\App\Scopes\UserScope::class)->withTrashed();
    }

    public function deductionFiles()
    {
        return $this->belongsToMany(\App\Models\File::class, 'deduction_files');
    }
}
