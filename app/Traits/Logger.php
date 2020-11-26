<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait Logger
{
    public function logRequest($request, $data = [])
    {
        $context = $this->_checkTypeData($data);
        $method = $request->method();
        $url = $request->url();

        Log::info("REQUEST: $method $url BODY: ", $context);
    }

    public function logResponse($request, $response = [])
    {
        $context = $this->_checkTypeData($response);
        $method = $request->method();
        $url = $request->url();

        Log::info("RESPONSE: $method $url BODY: ", $context);
    }

    private function _checkTypeData($typeData)
    {
        if (is_object($typeData)) $check = (array) $typeData;
        elseif (is_string($typeData)) $check = [$typeData];
        else $check = $typeData;

        return $check;
    }
}
