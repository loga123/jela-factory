<?php

namespace Database\Seeders;

use App\Models\Meal;
use Illuminate\Database\Seeder;
use Faker\Factory;
use FakerRestaurant\Provider\en_US\Restaurant;

class MealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $kategorije=[];

        for($i=1;$i<=100;$i++){
            array_push($kategorije,$i);
        }

        $faker = Factory::create();
        $faker->addProvider(new Restaurant($faker));

        //popuni jela sa kategorijama
        for($i=1;$i<=100;$i++){

            $random_keys=array_rand($kategorije);

            $title= $faker->foodName();
            $description = $faker->text;

            $meal = Meal::create([
                'id'=>$i,
                'slug' => "meal-" . ($i) . "",
                'category_id'=>$kategorije[$random_keys]
            ]);

            foreach (['hr','en', 'nl', 'fr', 'de'] as $locale) {
                $meal->translateOrNew($locale)->title = "" . ($title) ." jelo na ".strtoupper($locale)." jeziku";
                $meal->translateOrNew($locale)->description = strtoupper($locale)." jezik  - " . ($description);
            }

            $meal->save();
        }
    }
}
