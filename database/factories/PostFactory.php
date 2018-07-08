<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(7),
        'body' => $faker->text(500),
        'user_id' => App\User::all()->random()->id,
        'published_at' => \Carbon\Carbon::now()
    ];
});
