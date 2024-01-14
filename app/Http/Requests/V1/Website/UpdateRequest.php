<?php

namespace App\Http\Requests\V1\Website;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        $website = $this->route('website');

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:websites,name,' . $website->id,
            ],
            'url' => [
                'required',
                'string',
                'max:255',
                'unique:websites,url,' . $website->id,
            ],
        ];
    }
}
