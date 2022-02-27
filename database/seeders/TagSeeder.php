<?php

namespace Database\Seeders;

use App\Models\Tag;
use Faker\Provider\Address;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for($i=1;$i<=100;$i++){

           $tag = Tag::create([
                'id'=>$i,
                'slug' => "tag-" . ($i) . ""
            ]);

            foreach (['hr','en', 'nl', 'fr', 'de'] as $locale) {
                $tag->translateOrNew($locale)->title = "" . ($i) .". tag jela na ".strtoupper($locale)." jeziku";
            }

            $tag->save();
        }

    }
}
