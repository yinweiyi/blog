<?php

namespace App\Http\Requests;


class StoreImageRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'image_url'       => ['bail', 'required'],
            'prompt'          => ['bail', 'required'],
            'negative_prompt' => ['bail', 'required'],
        ];
    }
}
