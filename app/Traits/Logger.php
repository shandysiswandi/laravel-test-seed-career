<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait Logger
{
    public function logRequest($request, $data = [])
    {
        $context = (is_object($data)) ? (array) $data : $data;
        $method = $request->method();
        $url = $request->url();

        Log::info("REQUEST: $method $url BODY: ", $context);
    }

    public function logResponse($request, $response = [])
    {
        $context = (is_object($response)) ? (array) $response : $response;
        $method = $request->method();
        $url = $request->url();

        Log::info("RESPONSE: $method $url BODY: ", $context);
    }
}
