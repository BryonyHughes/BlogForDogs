<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use App\User;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    $commentable = [
    App\Post::class,
    App\Page::class,
  ];
  $commentableType = $faker -> randomElement($commentable);
  $commentable = factory($commentableType)->create();
    return [
      'comment_id'=>$commentable->id,
      'comment_type' => $commentableType,
      'body' => $faker-> paragraph($nbSentences = 3, $variableNbSentences = true),
      'date' => $faker-> date($format = 'Y-m-d', $max = 'now'),
      'user_id'=> User::inRandomOrder()->first()->id,
        //
    ];
});
