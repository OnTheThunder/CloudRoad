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

/*Route::get('/', function () {
    return view('welcome');
});
*/

/*Route::get('/', 'VehiculoController@create')->name('vehiculo.create');
Route::post('/', 'VehiculoController@store')->name('vehiculo.store');*/

Route::get('/', 'MainController@index')->name('main.index');
//Route::get('/', 'MainController@index')->name('main.index')->middleware('auth');

Route::get('/incidencias', 'IncidenciaController@index')->name('Incidencia.index');
Route::get('/incidencias/{id}', 'TecnicoController@show')->name('Tecnico.show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/usuario', 'UsuarioController@create')->name('usuario.create');
