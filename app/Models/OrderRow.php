<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderRow extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    protected $with = ['profile'];
    protected $appends = ['amount_percentage', 'amount_value', 'order_row_amount_value'];

    public function taxKey()
    {
        return $this->belongsTo(\App\Models\TaxKey::class);
    }

    public function vat()
    {
        return $this->belongsTo(\App\Models\ValueAddedTax::class);
    }

    public function agreement()
    {
        return $this->hasOne(\App\Models\Agreement::class);
    }

    public function profile()
    {
        return $this->belongsTo(\App\Models\Profile::class);
    }

    public function order()
    {
        return $this->belongsTo(\App\Models\Order::class);
    }

    public function getAmountPercentageAttribute()
    {
        return ($this->vat) ? $this->vat->percent : '0.00';
    }

    public function getAmountValueAttribute()
    {
        return number_format($this->amount - ($this->amount * ($this->taxKey->fee / 100)), 2);
    }

    public function getOrderRowAmountValueAttribute()
    {
        return number_format($this->amount * (1 + ($this->vat->percent / 100)), 2);
    }
}
