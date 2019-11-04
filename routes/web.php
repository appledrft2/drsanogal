<?php

use App\Client;
use App\Systemlog;
use App\Backuplist;

if (env('APP_ENV') === 'production') {
    URL::forceScheme('https');
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
// test module
Route::get('/dashboard/test','TestingController@index')->middleware('denyStaff');
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
Route::resource('/dashboard/attachmentcategory','FormCategoryController');

// Patient module
Route::any('/dashboard/client/{client}/patient/search','PatientController@search');
Route::resource('/dashboard/client/{client}/patient','PatientController');
// Patient List module
Route::any('/dashboard/patient/search','PatientListController@search')->middleware('denyStaff'); 
Route::get('/dashboard/patient','PatientListController@index')->middleware('denyStaff'); 
// Appointment List module
Route::any('/dashboard/appointmentlist/search','AppointmentListController@search');

Route::any('/dashboard/appointmentlist/reschedule','AppointmentListController@reschedule');

Route::get('/dashboard/appointmentlist','AppointmentListController@index');
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
Route::get('/dashboard/billing','BillingController@list'); 

Route::get('/dashboard/billing/{code}/receipt','BillingController@receipt'); 
Route::resource('/dashboard/billing/{id}/client','BillingController');
// Billing report
Route::get('/dashboard/billingreport','BillingReportController@index');
Route::post('/dashboard/billing/generateReport','BillingReportController@generateReport'); 

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
Route::get('/dashboard/suppliers/{code}/receipt','StockInController@receipt'); 
// Stock Out module
Route::get('/dashboard/stockout','StockOutController@index');
Route::post('/dashboard/stockout','StockOutController@store');
//Receipt module
Route::get('/dashboard/receipt/{rcode}','ReceiptController@index');
Route::get('/dashboard/report/','ReportController@index');
Route::post('/dashboard/report/generateReport','ReportController@generateReport');
// Inventory module
Route::get('/dashboard/inventoryreport/','InventoryReportController@index');
Route::post('/dashboard/inventoryreport/generateReport','InventoryReportController@generateReport');

// System Logs
Route::get('/dashboard/systemlog/','SystemlogController@index');

// Database import/export
Route::get('/dashboard/database/',function(){
	$backuplist = Backuplist::latest()->get();
	 $clientnotif = Client::all();
	return view('database.index',compact('backuplist','clientnotif'))->with('title','Database Backup/Restore');
});

Route::post('/dashboard/database',function(){
	$backuplist = Backuplist::latest()->get();
	 $clientnotif = Client::all();
	return view('database.index',compact('backuplist','clientnotif'))->with('title','Database Backup/Restore');
});

});

// Login module provided by laravel
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::post('/home/logout',function(){
	Systemlog::create(['user'=>Auth::user()->name ,'role' => ucfirst(Auth::user()->role) ,'activity' => "Logged Out Successfully"]);
	return response()->json(['status' => 'success']);
});
