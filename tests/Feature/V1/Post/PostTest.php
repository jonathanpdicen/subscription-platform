<?php

namespace Tests\Feature\V1\Post;

use App\Enums\PostStatusEnum;
use App\Models\Post;
use App\Models\Website;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function testCreatePost(): void
    {
        $website = Website::factory()
            ->create();

        $payload = [
            'title' => fake()->words(2, true),
            'description' => fake()->text($maxNbChars = 200),
            'status' => PostStatusEnum::DRAFT->value,
        ];

        $this->postJson("api/v1/websites/$website->id/posts", $payload)
            ->assertOk();

        $this->assertDatabaseHas('posts', $payload);
    }

    public function testPublishPost(): void
    {
        $post = Post::factory()->create();

        $this->putJson("api/v1/posts/$post->id/publish")
            ->assertOk();

        $this->assertEquals(PostStatusEnum::PUBLISHED->value, $post->fresh()->status);
    }
}
