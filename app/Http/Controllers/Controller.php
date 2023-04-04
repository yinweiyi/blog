<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * LengthAwarePaginator to useful page data
     *
     * @param LengthAwarePaginator $paginator
     * @return array
     */
    protected function toPageData(LengthAwarePaginator $paginator): array
    {
        return [
            'list'  => $paginator->items(),
            'total' => $paginator->total()
        ];
    }

    /**
     * return success message
     *
     * @param  $data
     * @param string $message
     * @return JsonResponse
     */
    protected function success($data = null, string $message = '成功'): JsonResponse
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
    protected function error($message, array $data = []): JsonResponse
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
