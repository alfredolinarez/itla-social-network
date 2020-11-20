<?php

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 50)->create()->each(function($user) {
            $user->posts()->saveMany(factory(Post::class, random_int(3, 10))->create([
                'user_id' => $user->id,
            ])->each(function($post) {
                $post->comments()->saveMany(factory(Comment::class, random_int(0, 5))->create([
                    'post_id' => $post->id,
                    'user_id' => function() { return random_int(1, 50); },
                ]));
            }));
        });
    }
}
