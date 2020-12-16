<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tag;
use Faker\Generator as Faker;

$factory->define(Tag::class, function (Faker $faker) {
    return [
        'topic' => $faker->randomElement(['For sale','Cute','Puppy','Playful','Adopt','Borrow','Walk']),
    ];
});
