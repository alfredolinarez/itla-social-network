<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  protected $fillable = [
    'comment',
  ];

  public function post() {
    return $this->belongsTo('App\Models\Post');
  }

  public function user() {
    return $this->belongsTo('App\Models\User');
  }
}
