<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silber\PageCache\Middleware\CacheResponse as BaseCacheResponse;

class CacheResponse extends BaseCacheResponse
{
    protected function shouldCache(Request $request, Response $response = null)
    {
        //DEBUG环境不缓存
        if (env('app_debug') == true && App::environment(['local','developed','testing'])){
            return false;
        }
        return $request->isMethod('GET') && (isset($response) && $response->getStatusCode() == 200);
    }
}
