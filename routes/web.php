<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserPostsController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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
Route::get('/', [PostController::class, 'index']);
Route::get('/home', [PostController::class, 'index']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::group(['prefix' => 'auth'], function () {
    Auth::routes();
});

// check for logged in user
Route::group(['middleware' => ['role:author']], function () {
    // show new post form
    Route::get('new-post', [PostController::class, 'create']);
    // save new post
    Route::post('new-post', [PostController::class, 'store']);
    // edit post form
    Route::get('edit/{slug}', [PostController::class, 'edit']);
    // update post
    Route::post('update', [PostController::class, 'update']);
    // delete post
    Route::get('delete/{post}', [PostController::class, 'destroy']);
    // display user's all posts
    Route::get('my-all-posts', [UserPostsController::class, 'user_posts_all']);
    // display user's drafts
    Route::get('my-drafts', [UserPostsController::class, 'user_posts_draft']);
    // store comment
    Route::post('comment/store', [CommentController::class, 'store']);
});

//users profile
Route::get('user/{user}', [UserProfileController::class, 'show'])->where('user.id', '[0-9]+');
// display list of posts
Route::get('user/{user}/posts', [UserPostsController::class, 'user_posts'])->where('user.id', '[0-9]+');
// display single post
Route::get('/{slug}', [PostController::class, 'show'])->where('slug', '[A-Za-z0-9-_]+');
