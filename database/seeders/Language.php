<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class Language extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages = [
            'HRVATSKI JEZIK',
            'ENGLESKI JEZIK',
            'FRANCUSKI JEZIK',
            'NJEMAČKI JEZIK',
            'NIZOZEMSKI JEZIK',
            'hr',
            'en',
            'fr',
            'de',
            'nl'
        ];

        for($i=0;$i<5;$i++){
            \App\Models\Language::create([
                'name' => $languages[$i],
                'slug' => $languages[$i+5]
            ]);

        }
    }
}
