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

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/// Auth Twitter
Route::get('auth/twitter', 'Auth\TwitterController@TwitterRedirect');
Route::get('auth/twitter/callback', 'Auth\TwitterController@TwitterCallback');
Route::get('auth/twitter/logout', 'Auth\TwitterController@getLogout');
