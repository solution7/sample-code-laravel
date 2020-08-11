<?php

namespace App\Http\Middleware;

use Closure;
use App;
use App\Models\Language as LanguageModel;
use App\Models\CountrySetting;
use Request;

define('RETURN_OBJECT', 1);

class Language
{
    //paths to ignore localization redirections
    private $ignorePaths = [];

    public function handle($request, Closure $next)
    {
        // APP_LANG get from cookie it's creating on language change
        $cookieLang = $request->cookie('APP_LANG');

        // get first request segment as url lang
        $urlLang = $request->segment(1);
        // all app languages array
        $appLanguages = LanguageModel::getAppCountryLanguages(false, $cookieLang ? true : false);
        $appLanguages['en'] = ['English'];
        $countryDefaultLang = CountrySetting::select('languages.short_code as default_lang')
                                              ->join('languages', 'languages.id', '=', 'country_settings.value')
                                              ->where(['country_settings.country_id'=>SYSTEM_COUNTRY_ID,
                                                        'country_settings.setting'=>'DEFAULT_LANGUAGE_ID'])
                                              ->first();

        if (!defined('URL_LANG')) {
            define('URL_LANG', isset($appLanguages[$urlLang])?$urlLang:'');
        }

        $urlLangWithDomain = ($urlLang == 'en')?SITE_DOMAIN.'_en':URL_LANG;

        // Set locale using url language
        if (Request::isMethod('get') && !Request::ajax() && !in_array(Request::path(), $this->ignorePaths)) {
            $currentLang = $urlLangWithDomain?:(($countryDefaultLang)?$countryDefaultLang->default_lang:'');
            $cookieLang = ($cookieLang && isset($appLanguages[$cookieLang]) &&
                            !empty($appLanguages[$cookieLang])) ? $cookieLang : '';

            if (!$urlLang && URL_LANG && $cookieLang) {
                App::setLocale($cookieLang);
            } elseif (!$currentLang) {
                App::setLocale(array_keys($appLanguages)[0]);
            } else {
                App::setLocale($currentLang);
            }
        }

        // if request language is not exiest in app language
        if ($request->setlang && !isset($appLanguages[$request->setlang])) {
            return Redirect($this->createURL($request, array_keys($appLanguages), $countryDefaultLang));
        }

        $locale = App::getLocale();

        if (!defined('SITE_LANG')) {
            define('SITE_LANG', '/' . $locale);
        }

        // change language and set it in the cookie
        if ($request->setlang && isset($appLanguages[$request->setlang])) {
            return Redirect($this->createURL($request, null, $countryDefaultLang))
                                  ->cookie('APP_LANG', $request->setlang, 60 * 24 * 365);
        }

        if ($countryDefaultLang && ($urlLangWithDomain == $countryDefaultLang->default_lang)) {
            return Redirect($this->createURL($request, null, $countryDefaultLang));
        }

        //check for uppercase country code
        if (ctype_upper($urlLang) && isset($appLanguages[strtolower($urlLang)])) {
            return Redirect($this->createURL($request, null, $countryDefaultLang));
        }

        return $next($request);
    }

    private function createURL($request, $redirectLang = false, $countryDefaultLang = null)
    {
        $path = $request->path();
        $urlLangWithDomain = (URL_LANG == 'en')?SITE_DOMAIN.'_en':URL_LANG;
        $changeablelang = ($request->setlang) ? $request->setlang :
          strtolower($redirectLang ? $redirectLang[0] : $urlLangWithDomain);

        if (empty(URL_LANG)) {
            $path = $changeablelang.'/'.$path;
        }

        $url = explode('/', $path);
        $cookieLang = $request->cookie('APP_LANG');
        $url[0] = $changeablelang;

        if (!empty($cookieLang) && !$request->setlang) {
            $url[0] = $cookieLang;
        }

        //check redirectLang
        if (!empty($redirectLang) && !in_array($url[0], $redirectLang)) {
            $url[0] = $redirectLang[0];
        }

        // remove lang from url if current language and country default language is same
        if ($countryDefaultLang && $countryDefaultLang->default_lang == $urlLangWithDomain) {
            $url[0] = null;
        }

        //check country english Language
        if (preg_match('/en/', $url[0], $match)) {
            $url[0] =$match[0];
        }

        return implode('/', $url);
    }
}
