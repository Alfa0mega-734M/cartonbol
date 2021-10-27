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

use App\Http\Controllers\PDFController;

Route::post('/validacion-iniciar-sesion', 'ValidacionIniciarSesionController@iniciar_sesion');
Route::post('/registro', 'ValidacionIniciarSesionController@registro')->name('registro');


Route::get('/detalle_producto', function () {
    return view('detalle_producto');
})->name('detalle');

Route::get('/comprobante', 'PDFController@PDF')->name('comprobantePDF');

Route::get('/', function () {
    return view('iniciar_sesion');
})->middleware('guest')->name('login');

Route::get('/registro', function (){
    return view('registro');
})->middleware('guest')->name('registro');


Route::middleware(['auth', 'administrativo'])->group(function () {
    Route::get('/panel-administrativo', 'VistasAdministrativoController@index');
});

Route::middleware(['auth', 'estandar'])->group(function () {
    Route::get('/productos', 'VistasEstandarController@index')->name('index');
});


Route::get('/cerrar-sesion', function(){
    //Cerrar la sesión
    Auth::logout();
    //Redireccionando a la ruta de Login
    return redirect()->route('login');
})->name('cerrar-sesion');