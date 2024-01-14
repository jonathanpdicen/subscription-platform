<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\PostStatusEnum;
use App\Http\Controllers\ModelController;
use App\Http\Requests\V1\Post\StoreRequest;
use App\Models\Post;
use App\Models\Website;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class PostController extends ModelController
{
    public function modelClass(): string
    {
        return Post::class;
    }

    public function store(Website $website, StoreRequest $request): JsonResource
    {
        $post = DB::transaction(
            function () use ($request, $website) {
                return $website->posts()->create($request->validated());
            }
        );

        return $this->respondModel($post);
    }

    public function publish(Post $post): JsonResource
    {
        $post = DB::transaction(
            function () use ($post) {
                $post->update([
                    'status' => PostStatusEnum::PUBLISHED->value
                ]);

                return $post;
            }
        );

        return $this->respondModel($post);
    }
}
