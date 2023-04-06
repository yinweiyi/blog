<?php

namespace App\Http\Requests;

class StoreSentenceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'author'      => ['bail', 'required'],
            'content'     => ['bail', 'required'],
            'translation' => ['bail', 'required'],
        ];
    }
}
