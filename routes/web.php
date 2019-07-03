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
	$announcements = \App\Announcement::orderBy('created_at','DESC')->paginate(4);
    return view('welcome',compact('announcements'));
});

// Dashboard module
Route::get('/dashboard','DashboardController@index')->middleware('auth');
// Client module
Route::any('/dashboard/client/search','ClientController@search')->middleware('auth');
Route::resource('/dashboard/client','ClientController')->middleware('auth');
//Announcement module
Route::any('/dashboard/announcement/search','AnnouncementController@search')->middleware('auth');
Route::resource('/dashboard/announcement','AnnouncementController')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
