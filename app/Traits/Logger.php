<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait Logger
{
    public function logRequest($request, $data = null)
    {
        $method = $request->method();
        $url = $request->url();
        Log::info("REQUEST: $method $url BODY: ", $data);
    }

    public function logResponse($request, $response = null)
    {
        $method = $request->method();
        $url = $request->url();
        Log::info("RESPONSE: $method $url BODY: ", $response);
    }
}
