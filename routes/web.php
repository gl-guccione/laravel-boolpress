<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Routes for logged users
Route::prefix('admin')->name('admin.')->namespace('Admin')->middleware('auth')->group(function () {
  Route::resource('posts', 'PostController');
});

// Routes for guests
Route::name('guest.')->namespace('Guest')->group(function () {
  Route::get('/posts', 'PostController@index')->name('posts.index');
  Route::get('/posts/show/{slug}', 'PostController@show')->name('posts.show');
});