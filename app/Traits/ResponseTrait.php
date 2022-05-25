<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ResponseTrait {

    /**
     * Create a new controller instance.
     *
     * @param $msg
     * @param int $statusCode
     * @param bool $is_authorized
     * @return JsonResponse
     */
    public function returnError($msg, int $statusCode = 200, bool $is_authorized = true): JsonResponse
    {
        return response()->json([
            'status'    => false,
            'msg'       => $msg,
            'data'      => null,
            'is_authorized' => $is_authorized
        ], $statusCode, ['Content-Type' => 'application/json;charset=UTF-8'],
            JSON_UNESCAPED_UNICODE);
    }

    /**
     * Create a new controller instance.
     *
     * @param $msg
     * @param int $statusCode
     * @return JsonResponse
     */
    public function returnSuccess($msg, int $statusCode = 200): JsonResponse
    {
        return response()->json([
            'status'    => true,
            'msg'       => $msg,
            'data'      => null,
            'is_authorized' => true
        ], $statusCode, ['Content-Type' => 'application/json;charset=UTF-8'],
            JSON_UNESCAPED_UNICODE);
    }


    /**
     * Create a new controller instance.
     *
     * @param $msg
     * @param $value
     * @param int $statusCode
     * @return JsonResponse
     */
    public function returnData($msg, $value, int $statusCode = 200): JsonResponse
    {
        return response()->json([
            'status'    => true,
            'msg'       => $msg,
            'data'      => $value,
            'is_authorized' => true
        ], $statusCode, ['Content-Type' => 'application/json;charset=UTF-8'],
            JSON_UNESCAPED_UNICODE);
    }
}
