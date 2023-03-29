<?php

namespace App\Http\Requests;


use App\Models\Comment;
use Illuminate\Validation\Rule;

class StoreCommentRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $types = array_keys(Comment::Types);
        return [
            'id'        => ['bail', 'required', 'integer'],
            'type'      => ['bail', 'required', Rule::in($types)],
            'parent_id' => ['bail', 'required', 'integer'],
            'nickname'  => ['bail', 'required'],
            'email'     => ['bail', 'email'],
            'content'   => ['bail', 'required'],
            'captcha'   => ['bail', 'required', 'captcha']
        ];
    }


    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'id.required'        => '评论的文章不存在',
            'id.integer'         => '评论的文章不存在',
            'type.required'      => '评论的文章不存在',
            'type.in'            => '评论的文章不存在',
            'parent_id.required' => '评论的文章不存在',
            'parent_id.integer'  => '评论的文章不存在',
            'nickname.required'  => '请填写昵称',
            'email.email'        => '邮箱格式不正确',
            'content.required'   => '请填写评论内容',
            'captcha.captcha'    => '验证码错误'
        ];
    }
}
