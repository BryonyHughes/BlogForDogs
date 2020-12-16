<?php

use Illuminate\Database\Seeder;

class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // Populate tags
    factory(App\Tag::class, 10)->create();

    // Populate posts
    factory(App\Post::class, 30)->create();

   // Get all the tags attaching up to 3 random tags to each post
   $tags = App\Tag::all();

  // Populate the pivot table
  App\Post::all()->each(function ($post) use ($tags) {
    $post->tags()->attach(
      $tags->random(rand(1, 3))->pluck('id')->toArray()
  );
});
    }
}
