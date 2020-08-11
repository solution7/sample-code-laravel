<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Country;

class CountrySettings
{
    public function handle($request, Closure $next)
    {
        if (!$request->isMethod('options') && !defined('SYSTEM_COUNTRY_ID')) {
            preg_match("/application\/vnd\.(.*?)\.api\+json/", $request->header('Accept'), $matches);

            $shortCode = $matches[1] ?? null;
            $country = Country::where('short_code', $shortCode)->where('site_enabled', 1)->first();

            if (!$country && env('APP_ENV') == 'local') {
                $country = Country::where('id', env('SYSTEM_COUNTRY_ID'))->where('site_enabled', 1)->first();
            }

            if (!$country) {
                abort(406, 'Invalid Accept header');
            }

            define('SYSTEM_COUNTRY_ID', $country->id);
            define('SITE_COUNTRY', $country->id);
            define('SITE_DOMAIN', $country->short_code);
            define('SITE_COUNTRY_NAME', $country->name);
        }

        return $next($request);
    }
}
