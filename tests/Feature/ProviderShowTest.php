<?php

namespace Tests\Feature;

use App\Models\Provider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProviderShowTest extends TestCase
{
    use RefreshDatabase;

    public function test_show_returns_single_provider(): void
    {
        $provider = Provider::factory()->create();

        $response = $this->getJson("/api/providers/{$provider->id}");

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'name',
            'description',
            'logo',
            'category' => [
                'id',
                'name',
            ]
        ]);
    }
}
