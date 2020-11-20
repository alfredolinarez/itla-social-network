<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FriendsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('guest')->group(function(){
    Route::prefix('login')->group(function() {
        Route::get('/', [AuthController::class, 'index'])->name('login');
        Route::post('/', [AuthController::class, 'login']);
    });

    Route::prefix('register')->group(function() {
        Route::view('/', 'register')->name('register');
        Route::post('/', [AuthController::class, 'register']);
    });
});

Route::middleware('auth')->group(function() {
    Route::prefix('/')->group(function() {
        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::post('/', [HomeController::class, 'createPost']);
    });

    Route::prefix('posts')->group(function() {
        Route::get('/{id}/delete', [HomeController::class, 'deletePost'])->name('post.delete');
        Route::get('/{id}/edit', [HomeController::class, 'editPost'])->name('post.edit');
        Route::get('/{id}/edit/cancel', [HomeController::class, 'cancelPostEditting'])->name('post.edit.cancel');
        Route::post('/{id}/edit', [HomeController::class, 'editPost']);
        Route::post('/{id}/comments', [HomeController::class, 'addPostComment'])->name('post.comment');
    });

    Route::prefix('friends')->group(function() {
        Route::get('/', [FriendsController::class, 'index'])->name('friends');
        Route::post('/', [FriendsController::class, 'addFriend']);
    });

    Route::get('/logout', function() {
        Auth::logout();
        return redirect('login');
    })->name('logout');
});
