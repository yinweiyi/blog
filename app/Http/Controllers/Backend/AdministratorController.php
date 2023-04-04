<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdministratorLoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdministratorController extends Controller
{

    /**
     * Login
     *
     * @param AdministratorLoginRequest $request
     * @return JsonResponse
     */
    public function info(Request $request): JsonResponse
    {
        $administrator = $request->user();
        return $this->success([
            'username' => $administrator->name,
            'roles' => ['admin']
        ]);
    }
}
