<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderStatus extends Model
{
    use SoftDeletes;

    const PENDING = 1;
    const APPROVED = 2;
    const APPROVED_WITH_A_MARK = 3;
    const DENIED = 4;
    const PREREGISTERED = 5;

    protected $guarded = [];
    protected $dates = ['deleted_at'];
    protected $appends = ['order_status_type_name'];

    public function orderStatusType()
    {
        return $this->belongsTo(\App\Models\OrderStatusType::class);
    }

    public function getOrderStatusTypeNameAttribute()
    {
        return $this->orderStatusType->name;
    }
}
