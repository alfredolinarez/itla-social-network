<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Friend;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FriendsController extends Controller
{
    public function index(Request $request) {
      $user = Auth::user();

      return view('friends', [
        'user' => $user,
      ]);
    }

    public function addFriend(Request $request) {
      /** @var \App\Models\User */
      $user = Auth::user();

      $username = $request->input('username');

      if(!$username) {
        return view('friends', [
          'user' => $user,
          'username_required' => true,
        ]);
      }

      $friend_user = User::firstWhere('username', $username);
      if($friend_user) {
        $friend = Friend::create([
          'user_id' => $user->id,
          'friend_id' => $friend_user->id,
        ]);
        return redirect()->route('friends');
      }

      return view('friends', [
        'user' => $user,
        'user_not_found' => true,
      ]);
    }

    public function deletePost(Request $request, $id) {
      $post = Post::find($id);

      $post->comments()->delete();
      $post->delete();

      return redirect()->route('home');
    }

    public function editPost(Request $request, $id) {
      $post = Post::find($id);

      if($request->isMethod('post')) {
        $content = $request->input('content');
        $request->session()->forget('post.editting');

        if(!$content) {
          return redirect()->route('home');
        }

        $post->content = $content;
        $post->save();
      } else {
        session([ 'post.editting' => $post->id ]);
      }

      return redirect()->route('home');
    }

    public function cancelPostEditting(Request $request, $id) {
      $request->session()->forget('post.editting');
      return redirect()->route('home');
    }


    public function addPostComment(Request $request, $id) {
      /** @var \App\Models\User */
      $user = Auth::user();

      $comment = $request->only('comment');
      $post = Post::find($id);

      $newComment = new Comment($comment);
      $newComment->user_id = $user->id;
      $newComment->post_id = $post->id;
      $newComment->save();

      return redirect()->route('home');
    }

}
