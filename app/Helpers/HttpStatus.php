<?php

namespace App\Helpers;

class HttpStatus
{
    /**
     * 20x
     */
    public static $OK = 200;
    public static $CREATED = 201;

    /**
     * 4x
     */
    public static $BAD_REQUEST = 404;
    public static $UNAUTHORIZED = 401;
    public static $NOT_FOUND = 404;
    public static $UNPROCESSABLE_ENTITY = 422;

    /**
     * 5x
     */
    public static $INTERNAL_SERVER_ERROR = 500;
}
