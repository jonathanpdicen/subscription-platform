<?php

namespace App\Http\Requests\V1\Subscriber;

use App\Models\Website;
use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubscribeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'string',
                'max:255',
                Rule::unique('subscribers')->where(function ($query) {
                    return $query->where('website_id', $this->route('website')->id);
                })
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique' => 'Email is already subscribed.',
        ];
    }
}
