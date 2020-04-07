<?php

use App\Category;
use App\Product;

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

		return view('tienda.index');
})->name('tienda');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', function () {

	return view('plantilla.admin');

});

Route::resource('/admin/category','Admin\AdminCategoryController')->names('admin.category');

Route::get('cancelar/{ruta}', function($ruta){

	return redirect()->route( $ruta )->with('cancelar','Se canceló la Acción');

})->name('cancelar');