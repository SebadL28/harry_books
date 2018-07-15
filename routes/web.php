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

Route::get('/', 'InicioController@index')->name('inicio');


Route::get('/cart', 'CartController@index')->name('cart');
Route::get('/cart/finalizar_compra', 'CartController@finalizarCompra');
Route::post('/cart/agregar_libro', 'CartController@agregarLibro');
Route::post('/cart/actualizar_cantidad', 'CartController@actualizarCantidadLibro');
Route::post('/cart/eliminar_pedido', 'CartController@eliminarLibro');
Route::post('/cart/cancelar_compra', 'CartController@cancelarCompra');

Route::get('/administracion', 'AdministracionController@index')->name('administracion');
Route::get('/administracion/informe/{id}', 'AdministracionController@informe');

Auth::routes();