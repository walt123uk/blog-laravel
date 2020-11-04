<?php

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
Route::get('/', [PostController::class,'index']);
Route::get('/home', ['as' => 'home', 'uses' => 'PostController@index']);

//authentication
// Route::resource('auth', 'Auth\AuthController');
// Route::resource('password', 'Auth\PasswordController');
Route::get('/logout', 'UserController@logout');
Route::group(['prefix' => 'auth'], function () {
    Auth::routes();
});
