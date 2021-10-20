<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silber\PageCache\Middleware\CacheResponse as BaseCacheResponse;

class CacheResponse extends BaseCacheResponse
{
    protected function shouldCache(Request $request, Response $response = null)
    {
        return $request->isMethod('GET') && (isset($response) && $response->getStatusCode() == 200);
    }
}
