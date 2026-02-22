<?php

namespace Modules\Core;

use Modules\Core\Transformers\ActionsResponse;

class System
{
    protected static ?ActionsResponse $response = null;
    public static function SetResponse(ActionsResponse $response) {
        static::$response = $response;
    }

    public static function HasResponse() : bool {
        return static::$response !== null;
    }

    public static function GetResponse() : ?ActionsResponse {
        return static::$response;
    }
}
