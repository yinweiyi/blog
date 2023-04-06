<?php

namespace App\Http\Requests;


class StoreFriendshipRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title'       => ['bail', 'required'],
            'link'        => ['bail', 'required', 'url'],
            'description' => ['bail'],
            'status'   => ['bail', 'required', 'boolean'],
        ];
    }
}
