<?php

namespace App\Http\Middleware;

use App\Models\Token;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TokenValidateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->exists('token') && strlen($request) == 64){
            $token = Token::where('token',$request['token'])->get();
            if ($token->isEmpty()){
                return response()->json([],403);
            }
            return $next($request);
        }else{
            return response()->json([],401);
        }
    }
}
