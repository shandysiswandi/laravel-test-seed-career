<?php

namespace App\Exceptions;

use App\Traits\ApiResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponse;

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        if ($e instanceof MethodNotAllowedHttpException) {
            $msg = "URL: `" . $request->path() . "` cannot be accessed with the `" . $request->method() . "` method";
            return $this->apiError($msg, 405);
        }

        if ($e instanceof NotFoundHttpException) {
            if ($request->segment(1) != 'api') {
                return parent::render($request, $e);
            }

            $msg = "URL: `" . $request->path() . "` not found in our system";
            return $this->apiError($msg, 404);
        }

        if ($e instanceof HttpException) {
            $code = $e->getStatusCode() ?: 500;
            $msg = $e->getMessage() ?: "HttpException";
            return $this->apiError($msg, $code);
        }

        if ($e instanceof AuthenticationException) {
            if ($request->segment(1) != 'api') {
                return parent::render($request, $e);
            }

            $msg = $e->getMessage() ?: "You Not Authentication";
            return $this->apiError($msg, 401);
        }

        if (config('app.debug')) {
            return parent::render($request, $e);
        }

        return $this->apiError('Unexpected Exception. Try later', 500);
    }
}
