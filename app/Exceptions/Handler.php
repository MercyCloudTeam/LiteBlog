<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        //API返回
        if ($request->exists('token')){//当token存在时候 返回
            return new JsonResponse(
                [
                    'data'=>$this->convertExceptionToArray($exception),
                    'msg'=>$exception->getMessage() ?? "Error",
                    'status'=>false,
                ],
                $this->isHttpException($exception) ? $exception->getStatusCode() : 500,
            );
        }
        //常规返回
        if ($exception instanceof HttpException) {
            $status = $exception->getStatusCode();
            if (view()->exists("errors.$status")) {
                return response(view("errors.$status"), $status);
            }
        }
        if (env('APP_DEBUG')) {
//            return parent::render($request, $exception);
            return $this->prepareResponse($request, $exception);
        } else {
            return response(view("errors.500"), 500);
        }
    }

}
