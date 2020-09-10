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
Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();


//rutas encargadas para el administrador en la parte de categorias
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/categoria', 'CategoriaController@index')->name('categoria')->middleware('admin');
Route::get('/manipular', 'CategoriaController@index1')->name('manipular')->middleware('admin');
Route::get('eliminar/{id}', 'CategoriaController@eliminarCat')->name('eliCat')->middleware('admin');
Route::get('editar/{id}', 'CategoriaController@editarCat')->name('ediCat')->middleware('admin');//me carga datos
Route::post('actualizarCat', 'CategoriaController@editarCategoria')->name('editarCategoria')->middleware('admin');//me edita los datos
Route::post('categoria', 'CategoriaController@insertarCategoria')->name('insertarCategoria')->middleware('admin');

//rutas encargadas para el administrador en la parte de productos
Route::get('/crearPro', 'ProductoController@index')->name('crearPro')->middleware('admin');//carga la vista
Route::post('/insertarPro', 'ProductoController@insertarPro')->name('insertarPro')->middleware('admin');
Route::get('/manipularPro', 'ProductoController@index1')->name('manipularPro')->middleware('admin');
Route::get('eliminarPro/{id}', 'ProductoController@eliminarPro')->name('eliPro')->middleware('admin');
Route::get('editarPro/{id}', 'ProductoController@editarPro')->name('cargarProEdi')->middleware('admin');//me carga datos
Route::post('editarPro', 'ProductoController@editarProducto')->name('editarProducto')->middleware('admin');//me edita los datos

//rutas encargadas para el lo que es la parte del cliente
Route::get('/cliente', 'ClienteController@index')->name('cliente')->middleware('cliente');
Route::get('/estadistica', 'ClienteController@estadistica')->name('estadistica')->middleware('cliente');
Route::get('cargarId/{id}', 'CarritoController@cargarId')->name('cargarId')->middleware('cliente');
Route::get('cargarPro', 'CarritoController@cargarPro')->name('cargarPro')->middleware('cliente');//para que el cliente vea lo que tieneen lista para comprar
Route::get('eliminarProSel/{id}', 'CarritoController@eliminarProSel')->name('eliProSel')->middleware('cliente');
Route::get('productoComprado', 'CarritoController@productoComprado')->name('productoComprado')->middleware('cliente');
Route::get('ordenCompra', 'ClienteController@ordenCompra')->name('ordenCompra')->middleware('cliente');