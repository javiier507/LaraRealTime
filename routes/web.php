<?php

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

//  APP

Route::group(['middleware' => ['auth']], function () {
	Route::get('/posts', 'PostController@index')->name('posts');
	Route::post('/vote', 'PostController@vote')->name('vote');
	Route::get('/charts', 'PostController@charts')->name('charts');
	Route::get('/userposts', 'PostController@userPosts');
});