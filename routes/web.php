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

/// Pages Controller Routes
Route::get('/', 'PagesController@index');
Route::get('/about','PagesController@about');


/// Post Controller Routes
Route::resource('posts','PostsController');
Route::get('/blog','PostsController@index');

/// Authentication  Routes
Auth::routes();

/// Dashboard Routes
Route::get('/dashboard', 'DashboardController@index');
Route::get('home','DashboardController@redirecter');

/// Shows Routes
Route::resource('shows','ShowsController');
Route::get('most-watched-anime','ShowsController@mostWatchedAnime');
Route::get('top-rated-anime','ShowsController@topRatedAnime');
Route::get('now-airing-anime','ShowsController@nowAiringAnime');

Route::get('most-watched-tv','ShowsController@mostWatchedTV');
Route::get('top-rated-tv','ShowsController@topRatedTV');
Route::get('now-airing-tv','ShowsController@nowAiringTV');

Route::get('most-watched-hollywood','ShowsController@mostWatchedHollywood');
Route::get('top-rated-hollywood','ShowsController@topRatedHollywood');

Route::get('most-watched-bollywood','ShowsController@mostWatchedBollywood');
Route::get('top-rated-bollywood','ShowsController@topRatedBollywood');

/// Users Route
Route::get('/users','UsersController@index');
Route::get('/users/user-search','UsersController@search');
