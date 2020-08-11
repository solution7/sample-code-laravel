<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Scopes\LanguageScope;

class Profession extends Model
{
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new LanguageScope);
    }

    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at'];
}
