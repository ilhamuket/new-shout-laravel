<?php

namespace App\Helpers;

class ResponseFormatter
{
    /**
     * Format the success response.
     *
     * @param  mixed  $data
     * @param  string $message
     * @param  int    $code
     * @return \Illuminate\Http\JsonResponse
     */
    public static function success($data, $message = 'Operation Successful', $code = 200)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * Format the error response.
     *
     * @param  string $message
     * @param  int    $code
     * @param  mixed  $errors
     * @return \Illuminate\Http\JsonResponse
     */
    public static function error($message = 'Operation Failed', $code = 500, $errors = null)
    {
        $response = [
            'status' => 'error',
            'message' => $message,
        ];

        if (!is_null($errors)) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $code);
    }
}
