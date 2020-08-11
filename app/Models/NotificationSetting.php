<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationSetting extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    protected $guarded = [];
}
