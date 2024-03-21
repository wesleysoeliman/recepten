<?php

namespace Database\Seeders;

use App\Models\Recipe;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Gebruik Faker om realistische testgegevens te genereren
        $faker = \Faker\Factory::create();

        // Loop om 20 recepten te maken
        for ($i = 0; $i < 20; $i++) {
            Recipe::create([
                'title' => $faker->sentence,
                'description' => $faker->paragraph,
                'image' => 'https://picsum.photos/640/480',
                // Voeg hier andere eigenschappen van het recept toe
            ]);
        }
    }
}
