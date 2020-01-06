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
Auth::routes();

Route::get('/', 'HomeController@index6')->name('home6');
// Route::get('/', 'HomeController@maintenance');

Route::get('/registeruser', 'LoadRegisterController@index');

Route::get('/home6', 'HomeController@index')->name('home');
Route::get('/home2', 'HomeController@index2')->name('home');
Route::get('/home3', 'HomeController@index3')->name('home');
Route::get('/home4', 'HomeController@index4')->name('home');
Route::get('/home5', 'HomeController@index5')->name('home');
Route::get('/home', 'HomeController@index6')->name('home');
Route::get('/home/downloadManual', 'HomeController@downloadManual');
Route::get('/home/read', 'HomeController@read');
Route::get('/home/read2', 'HomeController@read2');

Route::group(['prefix' => 'bidang'], function () {
	Route::get('/', 'BidangController@index');
	Route::post('/store', 'BidangController@store');
	Route::post('/update', 'BidangController@update');
	Route::get('/delete/{id}', 'BidangController@delete');
});

Route::group(['prefix' => 'booking'], function () {
	Route::get('/tesbaru', 'BookingController@tes');

	Route::get('/', 'BookingController@showAllBook');
	Route::get('/not', 'BookingController@showBookNotDone');
	Route::get('/done', 'BookingController@showBookDone');
	Route::get('/cancel', 'BookingController@showBookCancel');
	Route::get('/my-booking', 'BookingController@showBookMy');
	Route::get('/bidang-lain', 'BookingController@showBookOthers');
	Route::post('/confirm', 'BookingController@confirm');
	Route::get('/download/{id}', 'BookingController@download');
	Route::get('/form', 'BookingController@showForm');
	Route::post('/store', 'BookingController@store');
	Route::post('/updateRoom', 'BookingController@updateRoom');
	Route::post('/updateStatus', 'BookingController@updateBookStatus');
});

Route::group(['prefix' => 'book_status'], function () {
	Route::get('/', 'BookingStatusController@index');
	Route::post('/store', 'BidangController@store');
	Route::post('/update', 'BidangController@update');
	Route::get('/delete/{id}', 'BidangController@delete');
});

Route::group(['prefix' => 'list'], function () {
	Route::get('/bidang', 'ListController@getBidang');
	Route::get('/ruang', 'ListController@getRuang');
});

Route::get('/log/read', 'LogController@showLog');

Route::group(['prefix' => 'notulen'], function () {
	Route::get('/', 'NotulenController@index');
	Route::post('/store', 'NotulenController@store');
	Route::post('/storeHadir', 'NotulenController@storeHadir');
	Route::post('/storePhoto', 'NotulenController@storePhoto');
	Route::get('/download/{id}', 'NotulenController@download');
	Route::get('/downloadHadir/{id}', 'NotulenController@downloadHadir');
});

Route::group(['prefix' => 'roles'], function () {
	Route::get('/', 'UserTypeController@index');
	Route::post('/store', 'UserTypeController@store');
	Route::post('/update', 'UserTypeController@update');
	Route::get('/delete/{id}', 'UserTypeController@delete');
});

Route::group(['prefix' => 'ruang'], function () {
	Route::get('/', 'RoomController@index');
	Route::post('/store', 'RoomController@store');
	Route::post('/update', 'RoomController@update');
	Route::get('/delete/{id}', 'RoomController@delete');
});

Route::group(['prefix' => 'time'], function () {
	Route::get('/', 'TimeController@index');
	Route::post('/store', 'TimeController@store');
	Route::post('/update', 'TimeController@update');
	Route::get('/delete/{id}', 'TimeController@delete');
});

Route::group(['prefix' => 'tipe_ruang'], function () {
	Route::get('/', 'RoomTypeController@index');
	Route::post('/store', 'RoomTypeController@store');
	Route::post('/update', 'RoomTypeController@update');
	Route::get('/delete/{id}', 'RoomTypeController@delete');
});

Route::group(['prefix' => 'users'], function () {
	Route::get('/', 'UserController@index');
	Route::post('/update', 'UserController@update');
	Route::get('/delete/{id}', 'UserController@delete');
});