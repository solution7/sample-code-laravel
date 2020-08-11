<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Agreement extends Model
{
    protected $guarded = [];
    protected $dates = ['deleted_at'];
    protected $appends = ['customer_name', 'customer_email', 'invoice_id', 'user_id', 'path'];

    public function getCustomerNameAttribute()
    {
        if ($this->orderRow && $this->orderRow->order) {
            $customer = $this->orderRow->order->customer;
            return $customer->name;
        }
    }

    public function getCustomerEmailAttribute()
    {
        if ($this->orderRow && $this->orderRow->order) {
            $customer = $this->orderRow->order->customer;
            return $customer->email;
        }
    }

    public function getInvoiceIdAttribute()
    {
        if ($this->orderRow && $this->orderRow->order) {
            $order = $this->orderRow->order;
            return $order->invoice_id;
        }
    }

    public function getUserIdAttribute()
    {
        if ($this->orderRow && $this->orderRow->order) {
            $order = $this->orderRow->order;
            return $order->user_id;
        }
    }

    public function getPathAttribute()
    {
        if ($this->file) {
            return $this->file->path;
        }
    }

    public function file()
    {
        return $this->belongsTo(\App\Models\File::class);
    }

    public function orderRow()
    {
        return $this->belongsTo(\App\Models\OrderRow::class);
    }

    public function toFlatContractArray()
    {
        $this->setAppends(['customer_name','customer_email','invoice_id','user_id']);
    }

    public function getAgreementFile()
    {
        $this->setAppends(['path']);
    }

    public function scopePersonalContract($query)
    {
        return $query->where('agreement_type_id', 3);
    }

    public function scopeContracts($query)
    {
        return $query->where('order_row_id', '!=', null);
    }
}
