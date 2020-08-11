<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\CountryScope;

class TaxScheme extends Model
{
    use SoftDeletes;

    protected $guarded=[];
    protected $dates = ['deleted_at'];
    protected $hidden = ['country_id', 'value', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new CountryScope);
    }

    public function taxAssociation()
    {
        return $this->hasMany(\App\Models\TaxSchemeAssociation::class);
    }
}
