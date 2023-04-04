<?php

namespace App\Http\Requests;


use Illuminate\Validation\Rule;

class StoreCategoryRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'      => ['bail', 'required'],
            'slug'      => ['bail', 'required'],
            'order'     => ['bail', 'required', 'integer'],
            'parent_id' => [
                'bail',
                'required',
                'integer',
                Rule::when($this->post('parent_id') > 0, function () {
                    return [Rule::exists('categories', 'id')->where('parent_id', 0)];
                })
            ],
        ];
    }
}
