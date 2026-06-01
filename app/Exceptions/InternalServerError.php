<?php

namespace App\Exceptions;

use Exception;

class InternalServerError extends Exception
{
    public function render($request)
    {
        return response()->view('errors.500', [], 500);
    }
}