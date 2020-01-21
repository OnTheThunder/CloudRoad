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
Route::get('/', 'MainController@index')->name('main.index');


Route::post('/incidencias', 'IncidenciaController@store')->name('incidencia.store');
Route::get('/incidencias/create', 'IncidenciaController@create')->name('incidencia.create');
Route::get('/incidencias/{id}', 'IncidenciaController@show')->name('incidencia.show');


Route::post('/incidencias/store', 'IncidenciaController@store')->name('incidencia.store');
Route::get('/incidencias/create/map', 'IncidenciaController@displayMap')->name('incidencia.map');
Route::get('/incidencias', 'IncidenciaController@index')->name('incidencia.index');

//Llamadas desde AJAX
Route::get('/incidencias/create/map/getTalleres', 'IncidenciaController@getTalleres')->name('incidencia.getTalleres');
Route::get('/incidencias/create/map/taller/{idTaller}/getTecnicos', 'IncidenciaController@getTecnicosByTaller')->name('incidencia.getTecnicosByTaller');


Route::get('/getUser/{id}/{rol}', 'MainController@getUsuarioTipo')->name('getUser');



Route::get('/camaras',function (){return view('camara.camara');});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/usuario', 'UsuarioController@create')->name('usuario.create');
Route::get('/admin/datos', 'CoordinadorController@datos')->name('coordinador.datos'); //Tenemos que meterle middleware
Route::get('/admin/estadisticas', 'CoordinadorController@estadisticas')->name('coordinador.estadisticas'); //Tenemos que meterle middleware
