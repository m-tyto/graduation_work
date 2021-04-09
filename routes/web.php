<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

/// Auth Twitter
Route::get('auth/twitter', 'Auth\TwitterController@TwitterRedirect')->name('login');
Route::get('auth/twitter/callback', 'Auth\TwitterController@TwitterCallback');
Route::get('auth/twitter/logout', 'Auth\TwitterController@logout')->name('logout');

Route::get('/users/{id}', 'UserController@index')->name('user_home');
Route::get('/folder/create', 'FolderController@create')->name('folder_create');
Route::post('/folder/store', 'FolderController@store')->name('folder_store');
Route::post('/tweets/store', 'TweetController@tweets_folder')->name('tweets_folder_store');
Route::get('/folder/{id}', 'FolderController@index')->name('folder_index');
Route::get('tweets/get/{id}', 'TweetController@get_new_tweet')->name('get_new_tweet');