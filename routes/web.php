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

Auth::routes();

Route::get('/registeruser', 'LoadRegisterController@index');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/read', 'HomeController@read');

Route::group(['prefix' => 'bidang'], function () {
	Route::get('/', 'BidangController@index');
});

Route::group(['prefix' => 'booking'], function () {
	Route::get('/form', 'BookingController@showForm');
	Route::post('/store', 'BookingController@store');
});

Route::group(['prefix' => 'book_status'], function () {
	Route::get('/', 'BookingStatusController@index');
});

Route::group(['prefix' => 'roles'], function () {
	Route::get('/', 'UserTypeController@index');
});

Route::group(['prefix' => 'ruang'], function () {
	Route::get('/', 'RoomController@index');
});

Route::group(['prefix' => 'time'], function () {
	Route::get('/', 'TimeController@index');
});

Route::group(['prefix' => 'tipe_ruang'], function () {
	Route::get('/', 'RoomTypeController@index');
});

Route::group(['prefix' => 'users'], function () {
	Route::get('/', 'UserController@index');
});