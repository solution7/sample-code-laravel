<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationType extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    protected $guarded = [];

    const CREATE_WORKORDER = 1;
    const REGISTER_COWORKER = 2;

    public function notificationSetting()
    {
        return $this->hasOne(\App\Models\NotificationSetting::class);
    }
}
