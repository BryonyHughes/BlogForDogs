<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\User;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
      'title' => $faker->firstname(),
      'post' => $faker-> paragraph($nbSentences = 3, $variableNbSentences = true),
      'user_id'=> User::inRandomOrder()->first()->id,
    ];
});
