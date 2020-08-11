<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    protected $guarded = [];
    protected $hidden = ['token', 'created_at', 'updated_at'];

    public function invitedProfile()
    {
        return $this->belongsTo(\App\Models\Profile::class);
    }

    public function inviteeProfile()
    {
        return $this->belongsTo(\App\Models\Profile::class);
    }
}
