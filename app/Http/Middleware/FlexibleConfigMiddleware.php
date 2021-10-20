<?php

namespace App\Http\Middleware;

use Closure;
use GeoIp2\Database\Reader;
use Illuminate\Support\Facades\Storage;

class FlexibleConfigMiddleware
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
    //        Reader
    //        如果是来至CF的请求 采用CF的ip

            if (config('liteblog.ip_check') && Storage::has('GeoIP2-City.mmdb')){
                $reader = new Reader('/GeoIP2-City.mmdb');
            }
            return $next($request);
        }
}
