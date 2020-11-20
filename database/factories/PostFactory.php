<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Comment;
use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'content' => $faker->realText(),
        'created_at' => $faker->dateTimeInInterval('-1 month', '-2 weeks'),
        'updated_at' => $faker->dateTimeInInterval('-2 weeks'),
    ];
});
