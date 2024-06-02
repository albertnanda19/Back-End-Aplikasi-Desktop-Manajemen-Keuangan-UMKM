<?php

namespace App\Helpers;

class ResponseHelper
{
    /**
     * Create a standardized JSON response.
     *
     * @param int $status
     * @param string $message
     * @param mixed $data
     * @return \Illuminate\Http\JsonResponse
     */
    public static function createResponse(
        int $status,
        string $message,
        $data = null
    ) {
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
