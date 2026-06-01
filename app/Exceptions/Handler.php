<?php

namespace App\Exceptions;

use App\Exceptions\NotFoundHttpException;
use App\Exceptions\Forbidden;
use App\Exceptions\PageExpired;
use App\Exceptions\InternalServerError;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    public function render($request, Throwable $exception)
    {
        // Error 404
        if ($exception instanceof NotFoundHttpException) {
            return $exception->render($request);
        }
        
        // Error 403
        if ($exception instanceof Forbidden) {
            return $exception->render($request);
        }
        
        // Error 419
        if ($exception instanceof PageExpired) {
            return $exception->render($request);
        }
        
        // Error 500
        if ($exception instanceof InternalServerError) {
            return $exception->render($request);
        }

        return parent::render($request, $exception);
    }
}