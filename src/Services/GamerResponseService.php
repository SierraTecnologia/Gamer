<?php

namespace Gamer\Services;

use Illuminate\Support\Facades\Response;

class GamerResponseService
{
    /**
     * Generate an api response.
     *
     * @param string $type    Response type
     * @param string $message Response string
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function apiResponse($type, $message, $code = 200): \Illuminate\Http\JsonResponse
    {
        return Response::json(['status' => $type, 'data' => $message], $code);
    }

    /**
     * Generate an API error response.
     *
     * @param array $errors Validation errors
     * @param array $inputs Input values
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function apiErrorResponse($errors, $inputs): \Illuminate\Http\JsonResponse
    {
        $message = [];
        foreach ($inputs as $key => $value) {
            if (!isset($errors[$key])) {
                $message[$key] = [
                    'status' => 'valid',
                    'value' => $value,
                ];
            } else {
                $message[$key] = [
                    'status' => 'invalid',
                    'error' => $errors[$key],
                    'value' => $value,
                ];
            }
        }

        return Response::json(['status' => 'error', 'data' => $message]);
    }
}
