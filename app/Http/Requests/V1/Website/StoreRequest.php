<?php

namespace App\Http\Requests\V1\Website;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:websites,name',
            ],
            'url' => [
                'required',
                'string',
                'max:255',
                'unique:websites,url',
            ],
        ];
    }
}
