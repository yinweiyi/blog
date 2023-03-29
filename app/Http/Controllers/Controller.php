<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * return success message
     *
     * @param $message
     * @param array $data
     * @return JsonResponse
     */
    protected function success($message, $data = []): JsonResponse
    {
        return $this->response(200, $message, $data);
    }

    /**
     * return error message
     *
     * @param $message
     * @param array $data
     * @return JsonResponse
     */
    protected function error($message, $data = []): JsonResponse
    {
        return $this->response(400, $message, $data);
    }

    /**
     * response to client
     *
     * @param $code
     * @param $message
     * @param $data
     * @return JsonResponse
     */
    protected function response($code, $message, $data): JsonResponse
    {
        return response()->json(['message' => $message, 'code' => $code, 'data' => $data]);
    }
}
