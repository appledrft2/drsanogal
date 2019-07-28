<?php

if (env('APP_ENV') === 'production') {
    \URL::forceSchema('https');
}
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
Route::get('/announcement', 'FrontPageController@announcement');
Route::get('/products','FrontPageController@products');
Route::get('/services','FrontPageController@services');


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
Route::any('/dashboard/account/search','AccountController@search')->middleware('denyStaff'); 
Route::resource('/dashboard/account','AccountController')->middleware('denyStaff'); 
Route::patch('/dashboard/account/{id}/password','AccountController@UpdatePassword')->middleware('denyStaff'); 
Route::delete('/dashboard/account/{id}/destroy','AccountController@destroy')->middleware('denyStaff'); 
//Announcement module
Route::any('/dashboard/announcement/search','AnnouncementController@search');
Route::resource('/dashboard/announcement','AnnouncementController');
// Client module
Route::any('/dashboard/client/search','ClientController@search');
Route::resource('/dashboard/client','ClientController');
//Client Forms module
Route::resource('/dashboard/client/{client}/forms','ClientFormController');

// Patient module
Route::any('/dashboard/client/{client}/patient/search','PatientController@search');
Route::resource('/dashboard/client/{client}/patient','PatientController');
// Patient List module
Route::any('/dashboard/patient/search','PatientListController@search')->middleware('denyStaff'); 
Route::get('/dashboard/patient','PatientListController@index')->middleware('denyStaff'); 
// Appointment List module
Route::any('/dashboard/appointmentlist/search','AppointmentListController@search')->middleware('denyStaff'); 
Route::get('/dashboard/appointmentlist','AppointmentListController@index')->middleware('denyStaff'); 
Route::patch('/dashboard/appointmentlist/{id}','AppointmentListController@update')->middleware('denyStaff'); 
Route::patch('/dashboard/appointmentlist/{appointment_id}','AppointmentListController@UpdatePayment')->middleware('denyStaff'); 

//Appointment module
Route::patch('/dashboard/patient/{patient}/appointment/{appointment}/UpdateStatus','AppointmentController@UpdateStatus')->middleware('denyStaff');
Route::any('/dashboard/patient/{patient}/appointment/search','AppointmentController@search')->middleware('denyStaff');
Route::resource('/dashboard/patient/{patient}/appointment','AppointmentController')->middleware('denyStaff'); 

// Manage Appointment Module
Route::resource('/dashboard/services','ManageAppointmentController')->middleware('denyStaff'); 

// Preventive module
Route::any('/dashboard/appointment/{appointment}/detail/search','PreventiveController@search')->middleware('denyStaff');
Route::resource('/dashboard/appointment/{appointment}/detail','PreventiveController')->middleware('denyStaff'); 

// Billing module
Route::get('/dashboard/billing','BillingController@list')->middleware('denyStaff'); 
Route::get('/dashboard/billing/{code}/receipt','BillingController@receipt')->middleware('denyStaff'); 
Route::resource('/dashboard/billing/{id}/client','BillingController');
// Billing report
Route::get('/dashboard/billingreport','BillingReportController@index');

//Supplier module
Route::any('/dashboard/supplier/search','SupplierController@search');
Route::resource('/dashboard/supplier','SupplierController');
// Product module
Route::any('/dashboard/product/search','ProductController@search');
Route::resource('/dashboard/product','ProductController');
// Product Category module
Route::resource('/dashboard/productcategory','ProductCategoryController');
// Product Unit module
Route::resource('/dashboard/productunit','ProductUnitController');
// Stock In List module
Route::any('/dashboard/suppliers/search','StockInListController@search');
Route::get('/dashboard/suppliers/','StockInListController@index');
// Stock In module
Route::any('/dashboard/suppliers/{supplier}/stockin/search','StockInController@search');
Route::resource('/dashboard/suppliers/{supplier}/stockin','StockInController');
// Stock Out module
Route::get('/dashboard/stockout','StockOutController@index');
Route::post('/dashboard/stockout','StockOutController@store');
//Receipt module
Route::get('/dashboard/receipt/{rcode}','ReceiptController@index');
Route::get('/dashboard/report/','ReportController@index');
});

// Login module provided by laravel
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
