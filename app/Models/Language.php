<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Country;

class Language extends Model
{
    //
    protected $guarded = [];
    protected $hidden = ['country_id', 'created_at', 'updated_at'];


    public static function getAppCountryLanguages($object = false)
    {
        $siteCountry = Country::find(SITE_COUNTRY);

        $countryLanguage = self::getLanguages($object, true);
        if (!$countryLanguage) {
            $settingReferenceId = CountrySetting::getOne('DEFAULT_LANGUAGE_ID');
            $countryLanguage = self::where('id', $settingReferenceId);

            if (!$object) {
                $countryLanguage = $countryLanguage->pluck('name', 'short_code')->toArray();
            }
        }
        $return = $countryLanguage ? $countryLanguage : [];
        return $countryLanguage;
    }

    //if $returnType == RETURN_OBJECT then return object otherwise return Array
    public static function getLanguages($object = false, $systemLanguage = false)
    {
        $languages = new Language;
        if ($systemLanguage) {
            $languages = $languages->where('country_id', SITE_COUNTRY);
        }

        if ($object) {
            return $languages;
        }

        return $languages->pluck('name', 'short_code')->toArray();
    }


    public static function getLangByCode($langCode)
    {
        $lang = self::where('short_code', $langCode)->first();

        return $lang ? $lang->name : '';
    }

    public static function getLangIDByCode($langCode)
    {
        $self_id = self::where('short_code', $langCode)->value('id');
        if (!$self_id) {
            $langCode = SITE_DOMAIN.'_'.$langCode;
            $self_id = self::where('short_code', $langCode)->value('id');
        }
        return $self_id;
    }

    public static function getLangNameById($id)
    {
        return self::where('id', $id)->value('name');
    }

    /*
     *      Language and Country Relation
     */
    public function getLangCountry()
    {
        return $this->hasOne(\App\Models\Country::class, 'id', 'country_id');
    }
}
