<?php

namespace App\Http\Middleware;

use Closure;
use MaxMind\Db\Reader;

class GeoIPMiddleware
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
//        $reader = new Reader();
        return $next($request);

    }
}
