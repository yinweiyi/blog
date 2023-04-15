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
        $id = (int)$this->post('id');
        return [
            'name'  => ['bail', 'required'],
            'slug'  => ['bail', 'required', Rule::unique("tags", 'slug')->when($id > 0, function ($rule) use ($id) {
                return [$rule->ignore($id)];
            })]
        ];
    }
}
