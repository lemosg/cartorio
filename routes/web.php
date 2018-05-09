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

Route::get('/', 'HomeController@index')->name('index');
Route::group(['prefix' => 'certidao/{certidao}'], function() {
	Route::get('/', 'HomeController@certidao')->name('search.certidao');
	Route::group(['prefix' => 'uf/{uf}'], function() {
		Route::get('/', 'HomeController@uf')->name('search.uf');
		Route::group(['prefix' => 'municipio/{municipio}'], function() {
			Route::post('/request', 'HomeController@request')->name('search.submit');
		
			Route::get('/', 'HomeController@municipio')->name('search.municipio');
			Route::get('/pedido', 'HomeController@form')->name('search.pedido');
		});
	});
});	



Route::group(['prefix' => 'admin'], function() {
	Route::post('/convert-table', 'AdminController@convertTable')->name('admin.convert');

	Route::get('/panel', 'AdminController@panel')->name('admin.panel');
	Route::get('/', function() {
		return 'Admin';
	} )->name('admin');
});