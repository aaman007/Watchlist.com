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
Route::get('admin-panel/add-new-show','ShowsController@create');
Route::get('admin-panel/shows/store','ShowsController@store');

Route::get('most-watched-anime','ShowsController@mostWatchedAnime');
Route::get('top-rated-anime','ShowsController@topRatedAnime');
Route::get('currently-airing-anime','ShowsController@currentlyAiringAnime');

Route::get('most-watched-tv','ShowsController@mostWatchedTV');
Route::get('top-rated-tv','ShowsController@topRatedTV');
Route::get('currently-airing-tv','ShowsController@currentlyAiringTV');

Route::get('most-watched-hollywood','ShowsController@mostWatchedHollywood');
Route::get('top-rated-hollywood','ShowsController@topRatedHollywood');

Route::get('most-watched-bollywood','ShowsController@mostWatchedBollywood');
Route::get('top-rated-bollywood','ShowsController@topRatedBollywood');

/// Users Route
Route::get('/users','UsersController@index');
Route::get('/users/user-search','UsersController@search');
Route::get('/profile','UsersController@myProfile');
Route::get('/update-details','UsersController@updateDetails');
Route::get('/users/{id}','UsersController@userProfile');

// Admin Controller Routes
Route::get('/admin-panel','AdminsController@index');
Route::get('/admin-panel/logs','AdminsController@logs');
Route::get('admin-panel/posts','AdminsController@showPosts');
Route::get('admin-panel/users','AdminsController@showUsers');
Route::get('admin-panel/admins','AdminsController@showAdmins');
Route::get('admin-panel/shows','AdminsController@showShows');


// Staistics Controller Routes
Route::resource('statistics','StatisticsController');