<?php

namespace Tests\Feature\V1\Website;

use App\Models\Website;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Tests\TestCase;

class WebsiteTest extends TestCase
{
    use RefreshDatabase;

    public function testGetWebsites(): void
    {
        $websites = Website::factory()
            ->count(3)
            ->create();

        $expectedResponse = [
            'data' => $websites->map(
                function (Website $website) {
                    return Arr::only(
                        $website->toArray(),
                        [
                            'name',
                            'url'
                        ]
                    );
                }
            )
            ->values()
            ->toArray()
        ];

        $this->getJson('api/v1/websites')
            ->assertOk()
            ->assertJsonStructure(
                [
                    'data' => [
                        [
                            'name',
                            'url',
                        ]
                    ]
                ]
            )
            ->assertJson($expectedResponse);
    }

    public function testGetwebsite(): void
    {
        $website = website::factory()
            ->create();

        $this->getJson("api/v1/websites/$website->id")
            ->assertOk()
            ->assertJsonStructure(
                [
                    'data' => [
                        'name',
                        'url',
                    ]
                ]
            )
            ->assertJson(['data' => $website->toArray()]);
    }

    public function testCreatewebsite(): void
    {
        $payload = [
            'name' => fake()->words(2, true),
            'url' => fake()->domainName
        ];

        $this->postJson('api/v1/websites', $payload)
            ->assertOk();

        $this->assertDatabaseHas('websites', $payload);
    }

    public function testRequiredFieldsOnCreatewebsite(): void
    {
        $payload = [
            'name' => '',
            'url' => '',
        ];

        $this->postJson('api/v1/websites', $payload)
            ->assertStatus(422);
    }

    public function testUpdatewebsite(): void
    {
        $website = website::factory()
            ->create();

        $payload = [
            'name' => fake()->words(2, true),
            'url' => fake()->domainName,
        ];

        $this->putJson("api/v1/websites/$website->id", $payload)
            ->assertOk();

        $this->assertDatabaseHas('websites', $payload);
    }

    public function testDeletewebsite(): void
    {
        $website = website::factory()
            ->create();

        $this->deleteJson('/api/v1/websites/' . $website->id)
            ->assertStatus(204);

        $this->assertDatabaseMissing('websites', [
            'id' => $website->id,
        ]);
    }
}
