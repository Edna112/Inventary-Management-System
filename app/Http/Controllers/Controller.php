<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function result_ok($message, $data = [], $code)
    {
        return response()
            ->json([
                'message' => $message,
                'data' => $data,
                'code' => $code
            ], 200);
    }

    public function result_message($data, $code)
    {
        return response()
            ->json([
                'message' => $data,
                'code' => $code
            ], 200);
    }

    public function result_fail($errors = [], $code)
    {
        return response()
            ->json([
                'message' => $errors,
                'code' => $code
            ], $code);
    }
}
