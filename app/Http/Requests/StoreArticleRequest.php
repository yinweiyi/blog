<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class StoreArticleRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $id = (int)$this->post('id');
        return [
            'title'        => ['bail', 'required'],
            'slug'         => ['bail', 'required', Rule::unique('articles', 'slug')->ignore($id)],
            'order'        => ['bail', 'required', 'integer'],
            'views'        => ['bail', 'required', 'integer'],
            'tags'         => ['bail', 'required', 'array'],
            'content_type' => ['bail', 'required', 'integer'],
            'markdown'     => ['bail', Rule::requiredIf($this->content_type === 1)],
            'html'         => ['bail', Rule::requiredIf($this->content_type === 2)],
            'category_id'  => [
                'bail',
                'required',
                'integer',
                Rule::exists('categories', 'id')
            ],
            'keywords'     => ['bail', 'required'],
        ];
    }
}
