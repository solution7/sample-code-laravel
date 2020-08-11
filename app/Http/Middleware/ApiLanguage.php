<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\CountrySetting;
use App\Models\Language;

use App\Helpers\CommonHelper;

class ApiLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $lang = $request->header('Language');
        $UrlLang = $request->header('SystemLanguage');
        if (!empty($UrlLang)) {
            $UrlLang = '/'.$UrlLang;
        }

        if (!$lang) {
            $langId = CountrySetting::getOne('DEFAULT_LANGUAGE_ID');
            $lang = Language::find($langId)->short_code;
        }

        //define globa validation message
        if (!defined('VALIDATION_MESSAGE')) {
            define('VALIDATION_MESSAGE', CommonHelper::getValidationMessage($lang));
        }

        if (!defined('SITE_LANG')) {
            \App::setLocale($lang);
            define('SITE_LANG', '/' . $lang);
        }

        if (!defined('URL_LANG')) {
            define('URL_LANG', $UrlLang);
        }

        return $next($request);
    }
}
