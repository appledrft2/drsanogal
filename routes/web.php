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

// Homepage module
Route::get('/', 'FrontPageController@welcome');
Route::get('/about', 'FrontPageController@about');
Route::get('/products','FrontPageController@products');

//////////////////////////////////////////////////////////////////////////////////////////////
// Route group for auth
Route::group(['middleware'=>'auth'],function(){
// Dashboard module
Route::get('/dashboard','DashboardController@index');
Route::patch('/dashboard/UpdateStockin/{id}','DashboardController@UpdateStockin');
// My profile module
Route::get('/dashboard/profile','ProfileController@index');
Route::patch('/dashboard/profile/{id}','ProfileController@update');
Route::patch('/dashboard/profile/{id}/password','ProfileController@UpdatePassword');
// Accounts module
Route::any('/dashboard/account/search','AccountController@search')->middleware('denyStaff'); // staff cant access this module
Route::resource('/dashboard/account','AccountController')->middleware('denyStaff'); // staff cant access this module
Route::patch('/dashboard/account/{id}/password','AccountController@UpdatePassword')->middleware('denyStaff'); // staff cant access this module
Route::delete('/dashboard/account/{id}/destroy','AccountController@destroy')->middleware('denyStaff'); // staff cant access this module
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
Route::patch('/dashboard/patient/{patient}/appointment/{appointment}/UpdateStatus','AppointmentController@UpdateStatus')->middleware('denyStaff');
Route::any('/dashboard/patient/{patient}/appointment/search','AppointmentController@search')->middleware('denyStaff');
Route::resource('/dashboard/patient/{patient}/appointment','AppointmentController')->middleware('denyStaff'); // staff cant access this module
// Preventive module
Route::any('/dashboard/appointment/{appointment}/preventive/search','PreventiveController@search')->middleware('denyStaff');
Route::resource('/dashboard/appointment/{appointment}/preventive','PreventiveController')->middleware('denyStaff'); // staff cant access this module
//Supplier module
Route::any('/dashboard/supplier/search','SupplierController@search');
Route::resource('/dashboard/supplier','SupplierController');
// Product module
Route::any('/dashboard/product/search','ProductController@search');
Route::resource('/dashboard/product','ProductController');
// Stock In List module
Route::any('/dashboard/suppliers/search','StockInListController@search');
Route::get('/dashboard/suppliers/','StockInListController@index');
// Stock In module
Route::any('/dashboard/suppliers/{supplier}/stockin/search','StockInController@search');
Route::resource('/dashboard/suppliers/{supplier}/stockin','StockInController');
});

// Login module provided by laravel
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
