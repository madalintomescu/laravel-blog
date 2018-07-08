<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'body' => $faker->text(rand(200, 400)),
        'user_id' => App\User::all()->random()->id,
        'post_id' => App\Post::all()->random()->id
    ];
});
