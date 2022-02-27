<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<=100;$i++){

            $ingredient = Ingredient::create([
                'id'=>$i,
                'slug' => "ingredient-" . ($i) . ""
            ]);

            foreach (['hr','en', 'nl', 'fr', 'de'] as $locale) {
                $ingredient->translateOrNew($locale)->title = "" . ($i) .". sastojak jela na ".strtoupper($locale)." jeziku";
            }

            $ingredient->save();

        }

    }
}
