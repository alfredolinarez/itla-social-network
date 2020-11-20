<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user = User::find(1);
        echo "$user->fullname (@$user->username, id: $user->id) has:";
        echo count($user->posts) ." posts\n";
        echo count($user->friends) ." friends\n";

        echo "is friends with:\n";
        foreach ($user->friends as $friend) {
            echo "- $friend->fullname (@$friend->username, id: $friend->id, posts:". count($friend->posts) .")\n";
        }

        echo "total friends posts: ". count($user->friends_posts) ."\n";
        foreach ($user->friends_posts as $post) {
            echo "{$post->user->fullname} (@{$post->user->username}, post_id: $post->id, date: $post->created_at\n";
        }

        return 0;
    }
}
