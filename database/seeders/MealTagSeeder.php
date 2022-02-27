<?php

namespace Database\Seeders;

use App\Models\MealTag;
use Illuminate\Database\Seeder;

class MealTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //povezi jela i tagove
        $jela=[];
        for($i=1;$i<=100;$i++){
            array_push($jela,$i);
        }

        $tagovi=[];
        for($i=1;$i<=100;$i++){
            array_push($tagovi,$i);
        }

        for($i=0;$i<100;$i++) {
            //za svako jelo 3 taga
            for ($j = 0; $j < 3; $j++) {

                $randTag = array_rand($tagovi);

                while (MealTag::where('meal_id', $jela[$i])
                        ->where('tag_id',$tagovi[$randTag])
                        ->count() > 0
                ) {
                    $randTag = array_rand($tagovi);
                }

                MealTag::create([
                    'meal_id' => $jela[$i],
                    'tag_id' => $tagovi[$randTag]
                ]);

            }
        }
    }
}
