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

Route::get('/', 'MainController@index')->name('main.index')->middleware('auth');


Route::post('/incidencias', 'IncidenciaController@store')->name('incidencia.store');
Route::get('/incidencias/create', 'IncidenciaController@create')->name('incidencia.create')->middleware('auth');


Route::post('/incidencias/store', 'IncidenciaController@store')->name('incidencia.store');
Route::get('/incidencias/rechazadas', 'IncidenciaController@rechazadas')->name('incidencia.rechazadas');
Route::get('/incidencias/create/map', 'IncidenciaController@displayMap')->name('incidencia.map')->middleware('auth');
Route::get('/incidencias', 'IncidenciaController@index')->name('incidencia.index');
Route::get('/incidencias/update/{id}', 'IncidenciaController@update')->name('incidencia.update');





//Llamadas desde AJAX
Route::get('/incidencias/create/map/getTalleres', 'IncidenciaController@getTalleres')->name('incidencia.getTalleres');
Route::get('/incidencias/create/map/taller/{idTaller}/getTecnicos', 'IncidenciaController@getTecnicosByTaller')->name('incidencia.getTecnicosByTaller');


//para obtener datos de la tabla operario, tecnico, coordinador pasandole datos del usuario autenticado
Route::get('/getUser/{id}/{rol}', 'MainController@getUsuarioTipo')->name('getUser');


Route::get('/camaras', 'MainController@showCamaras')->name('camaras.show');

//Sustitucion de routes() por lo mismo, pero que se pueden editar. ~/vendor/laravel/framework/src/Illuminate/Routing/Router.php
//Auth::routes();
// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
//Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register.show');
//Route::post('register', 'Auth\RegisterController@register');

//passwor reset
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
//password confirm
Route::get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
Route::post('password/confirm', 'Auth\ConfirmPasswordController@confirm');

//email verification
Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');


Route::get('/home', 'HomeController@index')->name('home');

// crear usuarios
Route::get('/usuario', 'UsuarioController@create')->name('usuario.create');
Route::post('/usuario', 'UsuarioController@store')->name('usuario.store');
//baja usuario
Route::get('/usuario/edit', 'UsuarioController@edit')->name('usuario.baja.edit');
Route::get('/usuario/update', 'UsuarioController@update');// ajax para dar de baja o alta
Route::post('/usuario/edit', 'UsuarioController@update')->name('usuario.update');
// cambiar contraseña
Route::get('/usuario/password', 'UsuarioController@edit')->name('usuario.password.edit');

// get todos los talleres
Route::get('/talleres', 'TallerController@index')->name('talleres.index');

Route::get('/admin/datos', 'CoordinadorController@datos')->name('coordinador.datos'); //Tenemos que meterle middleware


Route::get('/send-mail', 'MailSendController@mailsend');
Route::get('/email-usuario', 'MailSendController@enviar')->name('nuevo.email');

//Estadisticas
Route::get('/admin/estadisticas', 'CoordinadorController@estadisticas')->name('coordinador.estadisticas'); //Tenemos que meterle middleware
Route::post('/admin/estadisticas/cargar', 'CoordinadorController@cargarGrafico')->name('coordinador.cargarGrafico'); //Tenemos que meterle middleware


//Filtro incidencias->tecnico
Route::get('/incidencias/tecnico/{id}/estado', 'IncidenciaController@getIncidenciasTecnicoEstado')->name('incidencias.tecnico.estado');
Route::get('/incidencias/tecnico/{id}/tipo', 'IncidenciaController@getIncidenciasTecnicoTipo')->name('incidencias.tecnico.tipo');

//Filtro incidencias->resto
Route::get('/incidencias/estado', 'IncidenciaController@getIncidenciasEstado')->name('incidencias.estado');
Route::get('/incidencias/tipo', 'IncidenciaController@getIncidenciasTipo')->name('incidencias.tipo');

//Tecnico
Route::post('/tecnico/update/{idTecnico}', 'TecnicoController@update')->name('tecnico.update');

//Las rutas con id siempre deben de ir al final para no dar conflicto
Route::get('/incidencias/{id}', 'IncidenciaController@show')->name('incidencia.show')->middleware('auth');

Route::get('/cliente/find-by-dni/{dni}', 'ClienteController@findByDni')->name('find.by.dni');

Route::get('/vehiculo/find-by-matricula/{matricula}', 'VehiculoController@findByMatricula')->name('find.by.matricula');

Route::get('/incidencias/{idIncidencia}/getCoordenadas', 'IncidenciaController@getCoordenadas')->name('incidencias.getCoordenadas');

Route::post('/incidencias/reasignarTecnico', 'IncidenciaController@reasignarTecnico');
