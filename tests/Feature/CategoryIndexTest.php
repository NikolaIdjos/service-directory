<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_all_categories(): void
    {
        Category::factory()->count(3)->create();

        $response = $this->getJson('/api/categories');

        $response->assertStatus(200);
        $response->assertJsonCount(3);

        $response->assertJsonStructure([
            '*' => ['id', 'name']
        ]);
    }
}
