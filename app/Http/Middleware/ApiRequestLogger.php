<?php

namespace App\Http\Middleware;

use Closure;
use App\ApiRequestLog;

class ApiRequestLogger
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
        define('API_REQUEST_LOGGER_START', microtime(true));
        return $next($request);
    }

    /**
    * Write request timing data after response have been sent to client.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Illuminate\Http\Response  $response
    * @return void
    */
    public function terminate($request, $response)
    {
        $executionTime = round(microtime(true) - API_REQUEST_LOGGER_START, 3);
        $this->logApiRequest($request, $response, $executionTime);
    }

    /**
    * Write request timing data after response have been sent to client.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Illuminate\Http\Response  $response
    * @return void
    */
    protected function logApiRequest($request, $response, $executionTime)
    {
        ApiRequestLog::create([
            'url' => $request->route()->uri,
            'method' => $request->method(),
            'status' => $response->status(),
            'body' => json_encode($request->all()),
            'executionTime' => $executionTime
        ]);
    }
}
