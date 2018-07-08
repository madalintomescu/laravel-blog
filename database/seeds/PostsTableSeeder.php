<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $posts = factory(App\Post::class, 10)->create()->each(function ($post) {
        $post->categories()->attach(App\Category::all()->random()->id);
        $post->tags()->attach(App\Tag::all()->random()->id);
    });
  }
}
