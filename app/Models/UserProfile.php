<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserProfile extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function profile()
    {
        return $this->belongsTo(\App\Models\Profile::class);
    }

    public function defaultProfile()
    {
        return $this->profile()->withoutGlobalScope(\App\Scopes\CountryScope::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function taxKey()
    {
        return $this->belongsTo(\App\Models\TaxKey::class);
    }
}
