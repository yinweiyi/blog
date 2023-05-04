<?php

namespace App\Http\Requests;


use Illuminate\Validation\Rule;

class ImageLikeRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'image_id' => ['bail', 'required'],
            'type'     => ['bail', 'required', Rule::in('likes', 'hearts')],
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'image_id.required' => '图片id不正确',
            'type.required'     => '类型不正确',
            'type.in'           => '类型不正确',
        ];
    }
}
