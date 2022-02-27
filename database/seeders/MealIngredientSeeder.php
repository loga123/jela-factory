<?php

namespace Database\Seeders;

use App\Models\MealIngredient;
use Illuminate\Database\Seeder;

class MealIngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $jela=[];
        for($i=1;$i<=100;$i++){
            array_push($jela,$i);
        }

        $sastojci=[];
        for($i=1;$i<=100;$i++){
            array_push($sastojci,$i);
        }


        for($i=0;$i<100;$i++) {
            //za svako jelo 3 sastojka
            for ($j = 0; $j < 3; $j++) {

                $randSastojak = array_rand($sastojci);

                while (MealIngredient::where('meal_id', $jela[$i])
                        ->where('ingredient_id', $sastojci[$randSastojak])
                        ->count() > 0
                ) {
                    $randSastojak = array_rand($sastojci);
                }

                MealIngredient::create([
                    'meal_id' => $jela[$i],
                    'ingredient_id' => $sastojci[$randSastojak]
                ]);

            }
        }


    }
}
