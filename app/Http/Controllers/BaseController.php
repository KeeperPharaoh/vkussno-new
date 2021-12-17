<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    /**
     * success response method.
     *
     * @param $result
     * @param string $message
     * @return JsonResponse
     */
    public function sendResponse($result, string $message = "Операция прошла успешно"): JsonResponse
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }

    public function sendSuccessMessage($message = "Операция прошла успешно"): JsonResponse
    {
        $response = [
            'success' => true,
            'message' => $message
        ];
        return response()->json($response,200);
    }

    public function sendError(string $message, $code = 403): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $message
        ];

        return response()->json($response,$code);
    }
}
