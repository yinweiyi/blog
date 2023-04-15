<?php

namespace App\Http\Requests;


use Illuminate\Validation\Rule;

class StoreTagRequest extends FormRequest
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
            'name'  => ['bail', 'required'],
            'slug'  => ['bail', 'required', Rule::unique('tags', 'slug')->ignore($id)]
        ];
    }
}
