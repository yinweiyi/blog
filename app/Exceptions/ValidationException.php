<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;
use Throwable;

class ValidationException extends Exception
{
    /**
     * @var Validator
     */
    protected Validator $validator;

    public function __construct(Validator $validator, $code = 0, Throwable $previous = null)
    {
        parent::__construct($validator->errors()->first(), $code, $previous);

        $this->validator = $validator;
    }

    /**
     * 渲染错误
     *
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        $data = ['code' => 422, 'message' => $this->validator->errors()->first(), 'data' => []];
        return response()->json($data);
    }
}
