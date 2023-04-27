<?php

namespace App\Http\Requests;


class StoreImageModelRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name'                    => ['bail', 'required'],
            'size'                    => ['bail', 'required', 'numeric'],
            'default_prompt'          => ['bail', 'required'],
            'default_negative_prompt' => ['bail', 'required'],
            'download_url'            => ['bail', 'required', 'url'],
            'order'                   => ['bail', 'required', 'integer'],
        ];
    }
}
