<?php

namespace App\Http\Requests\V1\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        $website = $this->route('website');

        return [
            'title' => [
                'required',
                'string',
                'max:255',
                'unique:posts,title'
            ],
            'description' => [
                'required',
                'string'
            ],
            'website_id' => [
                'exists:websites,id'
            ],
        ];
    }
}
