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
            'name'         => ['bail', 'required'],
            'size'         => ['bail', 'required', 'number'],
            'download_url' => ['bail', 'required', 'url'],
            'description'  => ['bail'],
            'order'        => ['bail', 'required', 'integer'],
            'status'       => ['bail', 'required', 'boolean'],
        ];
    }
}
