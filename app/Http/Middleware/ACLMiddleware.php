<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;

class ACLMiddleware
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
        $language = $request->segment(1);
        $uri = str_replace($language, '', $request->path());

        if ($uri == '/admin/dashboard' && (Session::has('super_admin') || !Auth::user()->isAdmin())) {
            return redirect('/'.$language.'/client/activities');
        } elseif (($uri == '/client/activities' && !Session::has('super_admin')) && (Auth::user()->isAdmin())) {
            return redirect('/'.$language.'/admin/dashboard');
        }

        return $next($request);
    }
}
