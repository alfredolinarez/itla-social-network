<?php

namespace App\Models;

use DateInterval;
use Illuminate\Database\Eloquent\Model;
use Moment\Moment;

class Post extends Model
{
    protected $fillable = [
        'content',
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function comments() {
        return $this->hasMany('App\Models\Comment');
    }

    public function getElapsedTimeAttribute() {
        $moment = new Moment(strtotime($this->created_at));
        $diff = $moment->from(strtotime(now()));

        return $diff->getRelative();
    }
}
