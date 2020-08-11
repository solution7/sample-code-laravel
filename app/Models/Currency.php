<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at', 'six_id'];

    public static $SIX_CURRENCY_MULTIPLIER = '0.994';
}
