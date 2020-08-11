<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CountrySetting extends Model
{
    protected $guarded = [];

    public static function getCountrySettingByCountryID($setting, $id)
    {

        if ($id) {
            $country = self::byCountryId($id);
        } else {
            $country = self::currentCountry();
        }

        $value = $country->where('setting', $setting)->value('value');

        //Check Default Country Setting value
        if (!$value) {
            $value = self::where('country_id', null)->where('setting', $setting)->value('value');
        }

        return ($value) ? json_decode($value, true)['value'] : '';
    }

    public static function getOne($setting, $id = null)
    {
        return self::getCountrySettingByCountryID($setting, $id);
    }

    public function scopeCurrentCountry($query)
    {
        return $query->where('country_id', SYSTEM_COUNTRY_ID);
    }

    public function scopeByCountryId($query, $id)
    {
        return $query->where('country_id', $id);
    }
}
