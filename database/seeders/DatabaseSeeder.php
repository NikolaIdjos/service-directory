<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Provider;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Category::factory()->count(5)->create()->each(function ($category) {
            Provider::factory()->count(10)->create([
                'category_id' => $category->id,
            ]);
        });
    }
}
