<?php
namespace App\services;

class Messages
{
    // Method for returning success responses
    public static function success($data = [], $msg = '')
    {
        return response()->json([
            'message' => $msg,
            'data' => $data
        ]);
    }

    // Method for returning error responses
    public static function error($msg = '', $status = 400)
    {
        return response()->json([
            'message' => $msg
        ], $status);
    }
}
