<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Food;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        
        for($i = 0; $i < 10; $i++) {
            Category::create([
                'name' => 'Category ' . $i,
                'slug' => 'category-' . $i,
                'description' => 'Description for category ' . $i,
            ]);

            for($j = 0; $j < 10; $j++) {
                Food::create([
                    'category_id' => $i + 1,
                    'name' => 'Food ' . $j,
                    'price' => rand(10000, 100000),
                    'description' => 'Description for food ' . $j,
                    'image' => 'food-' . $j . '.jpg',
                    'is_active' => true,
                ]);
            }
        }
    }
}
