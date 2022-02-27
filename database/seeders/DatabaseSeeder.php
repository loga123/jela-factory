<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CategorySeeder::class,
            TagSeeder::class,
            IngredientSeeder::class,
            MealSeeder::class,
            MealIngredientSeeder::class,
            MealTagSeeder::class,
            Language::class
        ]);

        // \App\Models\User::factory(10)->create();
    }
}
