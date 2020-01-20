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


//Route::get('/', 'MainController@index')->name('main.index');
Route::get('/', 'MainController@index')->name('main.index')->middleware('auth');


Route::post('/incidencias', 'IncidenciaController@store')->name('incidencia.store')->middleware('auth');
Route::get('/incidencias/create', 'IncidenciaController@create')->name('incidencia.create')->middleware('auth');
Route::get('/incidencias/{id}', 'IncidenciaController@show')->name('incidencia.show')->middleware('auth');
Route::get('/incidencias/create/taller', 'TallerController@index')->name('taller.index');
Route::get('/incidencias', 'IncidenciaController@index')->name('incidencia.index')->middleware('auth');


Route::get('/camaras',function (){return view('camara.camara');});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/usuario', 'UsuarioController@create')->name('usuario.create');
