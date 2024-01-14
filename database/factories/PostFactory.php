<?php

namespace Database\Factories;

use App\Enums\PostStatusEnum;
use App\Models\Post;
use App\Models\Website;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->name,
            'description' => fake()->text($maxNbChars = 200),
            'status' => PostStatusEnum::DRAFT->value,
        ];
    }

    public function configure(): self
    {
        return $this->afterMaking(
            function (Post $post) {
                if (!$post->website_id) {
                    $post->website_id = Website::factory()->create()->id;
                }
            }
        );
    }
}
