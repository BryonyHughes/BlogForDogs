<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  public function user()
  {
    return $this->belongsto('App\User');
  }
    //
    /**
     * Get all of the models that own comments.
     */
    public function commentable()
    {
        return $this->morphTo();
    }
}
