<?php

namespace App\Http\Requests;


use Illuminate\Validation\Rule;

class UpdateAdministratorRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $id = $this->post('id');
        return [
            'name'     => ['bail', 'required'],
            'account'  => ['bail', 'required', Rule::unique('administrator', 'account')->ignore($id)],
            'password' => ['bail', 'confirmed'],
            'status'   => ['bail', 'required', 'boolean']
        ];
    }


    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required'      => '用户名不能为空',
            'account.required'   => '账号不能为空',
            'account.unique'     => '账号已存在',
            'password.confirmed' => '两次输入密码不一致',
            'status.required'    => '状态不能为空',
            'status.boolean'     => '状态格式不正确',
        ];
    }
}
