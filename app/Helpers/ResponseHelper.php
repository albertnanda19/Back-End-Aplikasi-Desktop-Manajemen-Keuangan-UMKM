<?php

namespace App\Helpers;

class ResponseHelper
{
    public static function createResponse($status, $message, $data = null)
    {
        return response()->json(
            [
                "status" => $status,
                "message" => $message,
                "data" => $data,
            ],
            $status
        );
    }
}
