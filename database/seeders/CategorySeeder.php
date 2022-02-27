<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<=100;$i++){

            $category = Category::create([
                'id'=>$i,
                'slug' => "category-" . ($i) . ""
            ]);

            foreach (['hr','en', 'nl', 'fr', 'de'] as $locale) {
                $category->translateOrNew($locale)->title = "" . ($i) .". kategorija jela na ".strtoupper($locale)." jeziku";
            }

            $category->save();

        }

    }
}
