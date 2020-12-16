<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
  //
  /**
   * Get all of the page's comments.
   */
  public function comments()
  {
      return $this->morphMany('App\Comment', 'commentable');
  }
}
