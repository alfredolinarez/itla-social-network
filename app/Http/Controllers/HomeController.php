<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index(Request $request) {
      $user = Auth::user();

      $edittingId = session('post.editting');
      $editting = null;

      if($edittingId) {
        $editting = Post::find($edittingId);
      }

      return view('home', [
        'user' => $user,
        'editting' => $editting,
      ]);
    }

    public function createPost(Request $request) {
      /** @var \App\Models\User */
      $user = Auth::user();

      $content = $request->input('content');

      if(!$content) {
        return view('home', [
          'user' => $user,
          'content_required' => true,
        ]);
      }

      $user->posts()->create(['content' => $content]);

      return redirect()->route('home');
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

      if($post->user_id !== $user->id) {
        return redirect()->route('friends');
      }

      return redirect()->route('home');
    }

}
