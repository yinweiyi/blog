<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdministratorLoginRequest;
use App\Http\Requests\StoreAdministratorRequest;
use App\Models\Administrator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdministratorController extends Controller
{

    /**
     * 列表
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $administrators = Administrator::query()->orderByDesc('id')->get();

        return $this->success($administrators);
    }

    /**
     * 保存
     *
     * @param StoreAdministratorRequest $request
     * @return JsonResponse
     */
    public function store(StoreAdministratorRequest $request): JsonResponse
    {
        $attributes = $request->post();

        Administrator::query()->create($attributes);

        return $this->success();
    }

    /**
     * 更新
     *
     * @param Request $request
     * @param Administrator $administrator
     * @return JsonResponse
     */
    public function update(Request $request, Administrator $administrator): JsonResponse
    {
        $request->validate([
            'name'     => ['bail', 'required'],
            'account'  => ['bail', 'required', Rule::unique('administrator', 'account')->ignore($administrator->getAuthIdentifier())],
            'password' => ['bail', 'confirmed'],
            'status'   => ['bail', 'required', 'boolean']
        ], [
            'name.required'      => '用户名不能为空',
            'account.required'   => '账号不能为空',
            'account.unique'     => '账号已存在',
            'password.confirmed' => '两次输入密码不一致',
            'status.required'    => '状态不能为空',
            'status.boolean'     => '状态格式不正确',
        ]);

        $attributes = $request->post();
        $administrator->fill(array_filter_null($attributes))->save();
        return $this->success();
    }

    /**
     * 删除
     *
     * @param Administrator $administrator
     * @return JsonResponse
     */
    public function delete(Administrator $administrator): JsonResponse
    {
        if ($administrator->getAttribute('account') === 'admin') {
            return $this->error('不能删除超级管理员');
        }
        $administrator->delete();
        return $this->success();
    }

    /**
     * Info
     *
     * @param AdministratorLoginRequest $request
     * @return JsonResponse
     */
    public function info(Request $request): JsonResponse
    {
        $administrator = $request->user();
        return $this->success([
            'username' => $administrator->name,
            'roles'    => ['admin']
        ]);
    }


}
