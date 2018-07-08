<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = factory(App\Category::class, 10)->make();

        // Loop through all the generated categories and if the
        // name already exists append a random digit, so no
        // duplicates will be inserted in database.
        foreach ($categories as $category) {
            if (!App\Category::where('name', $category->name)->exists()) {
                App\Category::create(['name' => $category->name]);
            } else {
                do {
                    $category->name .= rand(0, 9);
                } while (App\Category::where('name', $category->name)->exists());
                if (!App\Category::where('name', $category->name)->exists()) {
                    App\Category::create(['name' => $category->name]);
                }
            }
        }
    }
}
