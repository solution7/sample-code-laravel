<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CountrySetting;

class Country extends Model
{
    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at'];

    public static function getAppCountries($object = false)
    {
        $appCountries = self::where('site_enabled', 1);

        if ($object) {
            return $appCountries;
        }

        $appCountries = $appCountries->pluck('short_code', 'id')->toArray();

        return $appCountries;
    }

    public static function getSystemCountry()
    {
        return self::where('id', SYSTEM_COUNTRY_ID)->first();
    }
}
