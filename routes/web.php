<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PerfilesController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\FacturasController;
use App\Http\Controllers\FormasPagoController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\CarritoController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Ruta Raiz
Route::get('/', function () {
    return view('index');
});
//->middleware('auth')

/* 
Aqui se agrega el middleware para proteger las rutas
*/
Route::group(['middleware' => 'auth'], function () {
    // Rutas protegidas que requieren autenticación
    Route::resource('perfiles', PerfilesController::class);
    Route::resource('facturas', FacturasController::class);
    Route::resource('formaspago', FormasPagoController::class);
    Route::resource('clientes', ClientesController::class);
    Route::resource('productos', ProductosController::class);
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Rutas para el carrito de compra

//Ruta hacia el carrito
//Route::get('carrito', ['as'=>'carrito', 'uses'=>'CarritoController@show']);
Route::get('carrito', [CarritoController::class, 'show'])->name('carrito');

//Ruta para agregar un producto al carrito
//Route::get('carrito/agregar/{id}', ['as' => 'carrito-agregar', 'uses' => 'CarritoController@add']);
Route::get('carrito/agregar/{id}', [CarritoController::class, 'add'])->name('carrito-agregar');

//Ruta para eliminar un producto del carrito
//Route::get('carrito/agregar/{id}', ['as' => 'carrito-agregar', 'uses' => 'CarritoController@delete']);
Route::get('carrito/borrar/{id}', [CarritoController::class, 'delete'])->name('carrito-borrar');

//Ruta para vaciar el carrito
//Route::get('carrito/vaciar', ['as' => 'carrito-vaciar', 'uses' => 'CarritoController@trash']);
Route::get('carrito/vaciar', [CarritoController::class, 'trash'])->name('carrito-vaciar');

//Ruta para actualizar la cantidad de productos en el carrito
//Route::get('carrito/actualizar/{id}/{cantidad?}', ['as' => 'carrito-actualizar', 'uses' => 'CarritoController@update']);
Route::get('carrito/actualizar/{id}/{cantidad?}', [CarritoController::class, 'update'])->name('carrito-actualizar');

//Ruta para guardar el pedido
//Route::get('ordenar', ['as' => 'ordenar', 'uses' => 'CarritoController@guardarPedido']);
Route::get('ordenar', [CarritoController::class, 'guardarPedido'])->name('ordenar');