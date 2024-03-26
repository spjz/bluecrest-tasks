<?php

namespace App\Classes;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class ResponseClass
{
    public static function rollback($e, $message = "Something went wrong! Process not completed")
    {
        DB::rollBack();
        self::throw($e, $message);
    }

    public static function throw($e, $message = "Something went wrong! Process not completed", $code = Response::HTTP_INTERNAL_SERVER_ERROR)
    {
        Log::info($e);
        throw new HttpResponseException(response()->json(["message" => $message], $code));
    }

    public static function notFound($message = "Could not find task", $code = Response::HTTP_NOT_FOUND)
    {
        throw new HttpResponseException(response()->json(["message" => $message], $code));
    }

    public static function sendResponse($result, $message, $code = Response::HTTP_OK)
    {
        $response = [
            'success' => true,
            'data'    => $result
        ];
        if (!empty($message)) {
            $response['message'] = $message;
        }
        return response()->json($response, $code);
    }
}
