<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\OrderStatus;
use App\Models\OrderRow;
use App\Models\OrderComment;
use App\Models\Expense;
use App\Models\AbstractModel;

use App\Scopes\UserScope;

class Order extends AbstractModel
{
    use SoftDeletes;

    protected $guarded = [];
    protected $dates = ['deleted_at'];
    protected $hidden = ['invoice_id', 'deleted_at'];
    public $appends = ['vat_percentage', 'invoice_id', 'order_status_type_name'];
    public $with = ['currency'];

    const PENDING_STATUS = 1;
    const APPROVED_STATUS = 2;
    const APPROVED_WITH_A_MARK_STATUS = 3;
    const DENIED_STATUS = 4;
    const PREREGISTER_STATUS = 5;

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new UserScope);
    }

    public static function deleteOrderReleted($customerId)
    {
        $orders = self::where('customer_id', $customerId)->get();
        if ($orders->count() > 0) {
            foreach ($orders as $order) {
                OrderRow::where('order_id', $order->id)->delete();
                OrderStatus::where('order_id', $order->id)->delete();
                OrderComment::where('order_id', $order->id)->delete();
                Expense::where('order_id', $order->id)->delete();
            }
            return true;
        }
        return false;
    }

    public function customer()
    {
        return $this->hasOne(\App\Models\Customer::class, 'id', 'customer_id')->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function rows()
    {
        return $this->hasMany(\App\Models\OrderRow::class);
    }

    public function comments()
    {
        return $this->hasMany(\App\Models\OrderComment::class);
    }

    public function status()
    {
        return $this->hasOne(\App\Models\OrderStatus::class)->latest();
    }

    public function currency()
    {
        return $this->belongsTo(\App\Models\Currency::class);
    }

    public function invoice()
    {
        return $this->belongsTo(\App\Models\Invoice::class);
    }

    public function getVatPercentageAttribute()
    {
        $vat = optional($this->rows->first())->vat;
        return optional($vat)->percentage;
    }

    public function getOrderStatusTypeNameAttribute()
    {
        return optional($this->status)->order_status_type_name;
    }

    public function scopePending($query)
    {
        return $query->whereHas('status', function ($q) {
            $q->where('order_status_type_id', OrderStatus::PENDING);
        });
    }

    public function scopeNotPending($query)
    {
        return $query->whereHas('status', function ($q) {
            $q->where('order_status_type_id', '!=', OrderStatus::PENDING);
        });
    }

    public function scopePreregistered($query)
    {
        return $query->whereHas('status', function ($q) {
            $q->where('order_status_type_id', OrderStatus::PREREGISTERED);
        });
    }

    public function scopeNotPreregistered($query)
    {
        return $query->whereHas('status', function ($q) {
            $q->where('order_status_type_id', '!=', OrderStatus::PREREGISTERED);
        });
    }

    public function isPending()
    {
        return (int) $this->status->order_status_type_id === OrderStatus::PENDING;
    }

    public function isPreregistered()
    {
        return (int) $this->status->order_status_type_id === OrderStatus::PREREGISTERED;
    }

    public function isEditable()
    {
        return $this->isPending() || $this->isPreregistered();
    }
}
