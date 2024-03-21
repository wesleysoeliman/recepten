<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Category::create([
            'name' => 'Breakfast',
            'description' => 'Recipes for breakfast meals',
        ]);
        
        // Create lunch category
        Category::create([
            'name' => 'Lunch',
            'description' => 'Recipes for lunch meals',
        ]);
        
        // Create dinner category
        Category::create([
            'name' => 'Dinner',
            'description' => 'Recipes for dinner meals',
        ]);
    }
}
