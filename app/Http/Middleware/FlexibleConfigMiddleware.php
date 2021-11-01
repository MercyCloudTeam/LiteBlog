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

//            TODO 写完节点之后实现，站点将记录地区，自动替换最近地区的站点的URL，例如访问RBQ.AI 若geoIP获取到用户在国内，如果节点列表内有国内站则将引用图片url全部切换到国内站
        }
}
