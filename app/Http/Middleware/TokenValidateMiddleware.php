<?php

namespace App\Http\Middleware;

use App\Models\Token;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;

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

        //例外情况 (开发测试)
        if (env('app_debug') == true && App::environment(['local','developed','testing'])){
            if ($request['token'] === "DEV"){
                return $next($request);
            }
        }

        //正常情况的验证令牌流程
        if ($request->exists('token')){
            $token = Token::where('token',$request['token'])->first();
            if (empty($token)){//没找到密钥
                return response()->json(['data'=>[],'status'=>false,'msg'=>'令牌错误'],403);
            }

            if ($token->author){//如果作者不为空 绑定作者
                $author_encrypt = Crypt::encryptString($token->author_id);
                $request->attributes->add(['author_encrypt'=>$author_encrypt]);
            }
            return $next($request);
        }else{
            return response()->json(['data'=>[],'status'=>false,'msg'=>'令牌不存在/长度不正确'],401);
        }
    }
}
