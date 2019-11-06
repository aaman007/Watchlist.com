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
