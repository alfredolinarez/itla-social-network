<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'password',
        'firstname',
        'lastname',
        'phone',
        'email',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
    ];

    public function getFullnameAttribute() {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function getAtUsernameAttribute() {
        return "@" . $this->username;
    }

    public function posts() {
        return $this->hasMany('App\Models\Post')->orderBy('created_at', 'DESC');
    }

    public function friends() {
        return $this->belongsToMany('App\Models\User', 'friends', 'user_id', 'friend_id');
    }

    public function getFriendsPostsAttribute() {
        $post_ids = $this->friends->reduce(function($posts, $friend) {
            return array_merge($posts, $friend->posts->modelKeys());
        }, []);

        return Post::whereIn('id', $post_ids)->orderBy('created_at', 'DESC')->get();
    }
}
