<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  //
  /**
   * Get all of the post's comments.
   */
 //public function comments()
  //{
    //  return $this->morphMany('App\Comment', 'commentable');
  //}

  public function user()
  {
    return $this->belongsto('App\User');
  }

  public function tags()
  {
    return $this->belongsToMany('App\Tag')->withPivot('tag_id');
  }

  public function comments()
  {
    return $this->hasMany('App\Comment');
  }
}
