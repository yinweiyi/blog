<?php

namespace App\Http\Requests;


class StoreTagRequest extends FormRequest
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
        ];
    }
}
