<?php

namespace App\Traits;

use App\Helpers\HttpStatus;

trait ApiResponse
{
    public function apiSuccess(string $msg = "", $data = null, int $statusCode = 0)
    {
        $statusCode = HttpStatus::$OK;

        return response()->json([
            'error' => false,
            'message' => $msg,
            'result' => $data
        ], $statusCode);
    }

    public function apiError($stack = null, int $statusCode = 0)
    {
        $statusCode = HttpStatus::$INTERNAL_SERVER_ERROR;

        return response()->json([
            'error' => true,
            'message' => $stack,
        ], $statusCode);
    }
}
