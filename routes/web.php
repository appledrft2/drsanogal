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
// Route group for auth
Route::group(['middleware'=>'auth'],function(){
// Dashboard module
Route::get('/dashboard','DashboardController@index');
//Announcement module
Route::any('/dashboard/announcement/search','AnnouncementController@search');
Route::resource('/dashboard/announcement','AnnouncementController');
// Client module
Route::any('/dashboard/client/search','ClientController@search');
Route::resource('/dashboard/client','ClientController');
// Patient module
Route::resource('/dashboard/client/{client}/patient','PatientController');
// Patient List
Route::get('/dashboard/patient','PatientListController@index');
});

// Login module
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
