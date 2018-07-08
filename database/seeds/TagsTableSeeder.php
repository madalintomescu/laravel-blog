<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
   */
    public function run()
    {
        $tags = factory(App\Tag::class, 10)->make();

        // Loop through all the generated tags and if the
        // name already exists append a random digit, so no
        // duplicates will be inserted in database.
        foreach ($tags as $tag) {
            if (!App\Tag::where('name', $tag->name)->exists()) {
                App\Tag::create(['name' => $tag->name]);
            } else {
                do {
                    $tag->name .= rand(0, 9);
                } while (App\Tag::where('name', $tag->name)->exists());
                if (!App\Tag::where('name', $tag->name)->exists()) {
                    App\Tag::create(['name' => $tag->name]);
                }
            }
        }
    }
}
