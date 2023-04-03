<?php

namespace App\Http\Requests;


class AdministratorLoginRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'account' => ['bail', 'required'],
            'password' => ['bail', 'required'],
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'account.required' => '账号不能为空',
            'password.required' => '密码不能为空',
        ];
    }
}
