<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Website extends JsonResource
{
    public function toArray(Request $request): array
    {
        return array_merge(
            parent::toArray($request),
            [
                'posts' => Post::collection($this->whenLoaded('posts'))
            ]
        );
    }
}
