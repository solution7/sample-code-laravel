<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CountrySetting;
use App\Models\Language;

class DefaultController extends Controller
{
    public function index(Request $request)
    {
        $data['publicSiteUrl'] = CountrySetting::getOne('PUBLIC_SITE_URL');
        $langId = CountrySetting::getOne('DEFAULT_LANGUAGE_ID');

        $data['defaultLang'] = Language::find($langId)->short_code;
        $data['languages'] = Language::where('country_id', SYSTEM_COUNTRY_ID)->select('short_code')->get();
        $data['requestURL'] = $request->URL();
        $data['segment1'] = $request->segment(1);

        $data['languages']->each(function ($language, $key) {
            $siteLang = explode('_', $language->short_code);
            if (in_array('en', $siteLang)) {
                $language['lang'] = count($siteLang) > 1 ? '/'.$siteLang[1] : '';
                $language['hrefLang'] = count($siteLang) > 1 ? $siteLang[1] : $siteLang[0];
            } else {
                $language['lang'] = count($siteLang) > 1 ? '/'.$language->short_code : '';
                $language['hrefLang'] = $language->short_code;
            }
        });

        return view('vue.index', $data);
    }
}
