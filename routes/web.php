<?php

use App\Post;
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
Route::get('admin-panel/shows/edit/{id}','ShowsController@edit');
Route::get('/admin-panel/shows/delete/{id}','ShowsController@destroy');

Route::get('most-watched-anime','ShowsController@mostWatchedAnime');
Route::get('top-rated-anime','ShowsController@topRatedAnime');
Route::get('currently-airing-anime','ShowsController@currentlyAiringAnime');
Route::get('upcoming-anime','ShowsController@upcomingAnime');

Route::get('most-watched-tv','ShowsController@mostWatchedTV');
Route::get('top-rated-tv','ShowsController@topRatedTV');
Route::get('currently-airing-tv','ShowsController@currentlyAiringTV');
Route::get('upcoming-tv','ShowsController@upcomingTV');

Route::get('most-watched-hollywood','ShowsController@mostWatchedHollywood');
Route::get('top-rated-hollywood','ShowsController@topRatedHollywood');
Route::get('upcoming-hollywood','ShowsController@upcomingHollywood');

Route::get('most-watched-bollywood','ShowsController@mostWatchedBollywood');
Route::get('top-rated-bollywood','ShowsController@topRatedBollywood');
Route::get('upcoming-bollywood','ShowsController@upcomingBollywood');

Route::get('anime-search','ShowsController@searchAnime');

/// Users Route
Route::get('/users/user-search','UsersController@search');
Route::resource('users','UsersController');
Route::get('/users/{id}/watching','UsersController@watching');
Route::get('/users/{id}/completed','UsersController@completed');
Route::get('/users/{id}/on-hold','UsersController@onHold');
Route::get('/users/{id}/dropped','UsersController@dropped');
Route::get('/users/{id}/plan-to-watch','UsersController@planToWatch');
Route::get('/update-details','UsersController@update_details');
Route::get('/profile','UsersController@profile');
//Route::get('/profile','UsersController@myPosts');
Route::get('/profile/watching','UsersController@myWatching');
Route::get('/profile/completed','UsersController@myCompleted');
Route::get('/profile/on-hold','UsersController@myOnHold');
Route::get('/profile/dropped','UsersController@myDropped');
Route::get('/profile/plan-to-watch','UsersController@myPlanToWatch');

// Admin Controller Routes
Route::get('/admin-panel/shows/filter','AdminsController@filter');
Route::get('/admin-panel','AdminsController@index');
Route::get('/admin-panel/logs','AdminsController@logs');
Route::get('admin-panel/posts','AdminsController@showPosts');
Route::get('admin-panel/users','AdminsController@showUsers');
Route::get('admin-panel/users/promote/{id}','AdminsController@promote');
Route::get('admin-panel/users/demote/{id}','AdminsController@demote');
Route::get('admin-panel/admins','AdminsController@showAdmins');
Route::get('admin-panel/shows','AdminsController@showShows');
Route::get('admin-panel/shows/{id}','AdminsController@viewShow');


// Staistics Controller Routes
Route::resource('statistics','StatisticsController');

// AdminPanel Posts Controller Routes
Route::get('/admin-panel/posts/delete/{id}','AdminPostsController@destroy');
Route::get('/admin-panel/posts/edit/{id}','AdminPostsController@edit');
Route::get('/admin-panel/posts/{id}','AdminPostsController@show');
Route::put('/admin-panel/posts/update/{id}','AdminPostsController@update')->name('admin.posts.update');
