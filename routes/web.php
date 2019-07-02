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
    return view('welcome');
});
// Dashboard module
Route::get('/dashboard','DashboardController@index');
// Client module
Route::post('/dashboard/client/search','ClientController@search');
Route::get('/dashboard/client/search','ClientController@index');
Route::resource('/dashboard/client','ClientController');

