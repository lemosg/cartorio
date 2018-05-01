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



Route::group(['prefix' => 'admin'], function() {
	Route::post('/convert-table', 'AdminController@convertTable')->name('admin.convert');

	Route::get('/panel', 'AdminController@panel')->name('admin.panel');
});