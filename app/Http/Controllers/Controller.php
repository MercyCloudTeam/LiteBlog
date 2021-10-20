<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * API 返回结果模板
     * @param array $data
     * @param bool $status
     * @param string $msg
     * @return JsonResponse
     */
    public function apiResult(array $data = [],bool $status = true,string $msg = ''): JsonResponse
    {
        return response()->json([
            'data'=>$data,
            'msg'=>$msg,
            'status'=>$status,
        ]);
    }
}
