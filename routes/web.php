<?php

use App\Category;
use App\Product;
use App\Image;


Route::get('/prueba', function () {

    //20 eliminar imagen

	$producto = Product::with('images','category')->orderBy('id','desc')->get();
	return $producto;
});

Route::get('/resultado', function () {

		$producto = Product::find(3);
		return $producto->images;
});



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


Route::middleware('auth')->group(function(){
	
	Route::resource('/admin/category','Admin\AdminCategoryController')->names('admin.category');
	Route::resource('/admin/product','Admin\AdminProductController')->names('admin.product');
	Route::get('/admin', function () {
		return view('plantilla.admin');
	})->name('admin');
	
});

<<<<<<< 6d8447caaa9cf533eebf4b3171538f697a105f37
Route::middleware('auth')->group(function(){
	
	Route::resource('/admin/category','Admin\AdminCategoryController')->names('admin.category');
	Route::resource('/admin/product','Admin\AdminProductController')->names('admin.product');
	
	Route::get('/admin', function () {
		return view('plantilla.admin');
	})->name('admin');
	
});

Route::resource('/admin/category','Admin\AdminCategoryController')->names('admin.category');
Route::resource('/admin/product','Admin\AdminProductController')->names('admin.product');
=======
>>>>>>> CRUD de Productos y Categorias

Route::get('cancelar/{ruta}', function($ruta){

	return redirect()->route( $ruta )->with('cancelar','Se canceló la Acción');

})->name('cancelar');