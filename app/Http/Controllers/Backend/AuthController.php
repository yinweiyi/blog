<?php

namespace App\Http\Controllers\Backend;

use App\Events\LoginedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdministratorLoginRequest;
use App\Models\Administrator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    /**
     * Login
     *
     * @param AdministratorLoginRequest $request
     * @return JsonResponse
     */
    public function login(AdministratorLoginRequest $request): JsonResponse
    {
        $administrator = Administrator::query()->where('account', $request->account)->first();
        if (! $administrator || ! Hash::check($request->password, $administrator->password)) {
            return $this->error('账号或密码不正确');
        }
        $token = $administrator->createToken(Config::get('sanctum.token_name'))->plainTextToken;

        LoginedEvent::dispatch($administrator);

        return $this->success( compact('token'));
    }
}
