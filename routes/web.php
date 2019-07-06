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

// Home page, yeah i still use welcome.blade.php LOL
Route::get('/', function () {
	$announcements = \App\Announcement::orderBy('created_at','DESC')->paginate(1);
	$products = \App\Product::orderBy('created_at','DESC')->paginate(6);
	$products =  $products->appends(array ('data' => 'product'));
    return view('welcome',compact('announcements','products'));
});
// Route group for auth
Route::group(['middleware'=>'auth'],function(){
// Dashboard module
Route::get('/dashboard','DashboardController@index');
// My profile module
Route::get('/dashboard/profile','ProfileController@index');
Route::patch('/dashboard/profile/{id}','ProfileController@update');
Route::patch('/dashboard/profile/{id}/password','ProfileController@UpdatePassword');
// Accounts module
Route::resource('/dashboard/account','AccountController')->middleware('denyStaff'); // staff cant access this module
//Announcement module
Route::any('/dashboard/announcement/search','AnnouncementController@search');
Route::resource('/dashboard/announcement','AnnouncementController');
// Client module
Route::any('/dashboard/client/search','ClientController@search');
Route::resource('/dashboard/client','ClientController');
// Patient module
Route::any('/dashboard/client/{client}/patient/search','PatientController@search');
Route::resource('/dashboard/client/{client}/patient','PatientController');
// Patient List module
Route::any('/dashboard/patient/search','PatientListController@search')->middleware('denyStaff'); // staff cant access this module
Route::get('/dashboard/patient','PatientListController@index')->middleware('denyStaff'); // staff cant access this module
//Appointment module
Route::resource('/dashboard/patient/{patient}/appointment','AppointmentController')->middleware('denyStaff'); // staff cant access this module
//Supplier module
Route::any('/dashboard/supplier/search','SupplierController@search');
Route::resource('/dashboard/supplier','SupplierController');
// Product module
Route::any('/dashboard/product/search','ProductController@search');
Route::resource('/dashboard/product','ProductController');
});

// Login module provided by laravel
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
