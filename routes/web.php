<?php

use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth'])->group(function () {
	Route::get('/', function () {
		return view('dashboard');
	});

	Route::get('/divisas/buscar','DivisasController@buscar');
	Route::resource('divisas','DivisasController');
	
	Route::get('/proveedores/buscar','ProveedorController@buscar');
	Route::resource('proveedores','ProveedorController');

	Route::get('/productos/buscar', 'ProductosController@buscar');
	Route::resource('productos', 'ProductosController');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
