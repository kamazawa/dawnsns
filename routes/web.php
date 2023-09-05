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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');


//ログイン中のページ
Route::get('/top','PostsController@index');
Route::post('/top','PostsController@index');
Route::post('posts/create', 'PostsController@create');
Route::get('/post/{id}/delete','PostsController@delete');
Route::put('/post/{id}/update','PostsController@update');

Route::get('/profile','UsersController@show');
Route::post('profile/update','UsersController@update');

Route::get('/search','UsersController@search');
Route::post('/user.search','UsersController@search');
Route::post('/users/{id}/follow','UsersController@follow');
Route::post('/users/{id}/unfollow','UsersController@unfollow');
Route::get('/users/{id}/profile','FollowsController@profile');

Route::get('/follow-list','FollowsController@followList');
Route::get('/follower-list','FollowsController@followerList');
Route::get('/follow-list/{id}/profile','FollowsController@profile');
Route::get('/follower-list/{id}/profile','FollowsController@profile');
Route::post('/follow/{id}/follow','FollowsController@follow');
Route::post('/follow/{id}/unfollow','FollowsController@unfollow');

Route::get('/logout',
'Auth\LoginController@logout');

Route::get('/logout',
'Auth\LoginController@logout');
Route::post('/logout',
'Auth\LoginController@logout');
