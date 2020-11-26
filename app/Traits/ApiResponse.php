<?php

namespace App\Traits;

trait ApiResponse
{
    public function apiSuccess(string $msg = "", $data = null, $statusCode = 200)
    {
        return response()->json([
            'error' => false,
            'message' => $msg,
            'result' => $data
        ], $statusCode);
    }

    public function apiError($stack = null, $statusCode = 500)
    {
        return response()->json([
            'error' => true,
            'message' => $stack,
        ], $statusCode);
    }
}
