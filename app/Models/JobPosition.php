<?php

namespace App\Models;

use App\Scopes\CountryScope;

use Illuminate\Database\Eloquent\Model;

class JobPosition extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new CountryScope);
    }
}
