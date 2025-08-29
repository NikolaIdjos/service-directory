<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Provider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProviderIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_paginated_providers(): void
    {
        $category = Category::factory()->create();
        Provider::factory()->count(15)->create(['category_id' => $category->id]);

        $response = $this->getJson('/api/providers');

        $response->assertStatus(200);
        $this->assertCount(12, $response->json('data'));
    }

    public function test_index_filters_providers_by_category(): void
    {
        $cat1 = Category::factory()->create();
        $cat2 = Category::factory()->create();

        Provider::factory()->count(5)->create(['category_id' => $cat1->id]);
        Provider::factory()->count(3)->create(['category_id' => $cat2->id]);

        $response = $this->getJson("/api/providers?category_id={$cat1->id}");

        $response->assertStatus(200);
        $this->assertCount(5, $response->json('data'));
    }
}
