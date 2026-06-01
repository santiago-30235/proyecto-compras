<?php

namespace App\Exceptions;

use Exception;

class Forbidden extends Exception
{
    public function render($request)
    {
        return response()->view('errors.403', [], 403);
    }
}