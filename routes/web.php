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
Route::get('/incidencias/{id}', 'IncidenciaController@show')->name('incidencia.show');


Route::post('/incidencias/store', 'IncidenciaController@store')->name('incidencia.store');
Route::get('/incidencias/create/map', 'IncidenciaController@displayMap')->name('incidencia.map');
Route::get('/incidencias', 'IncidenciaController@index')->name('incidencia.index');

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
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

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

Route::get('/usuario', 'UsuarioController@create')->name('usuario.create');
Route::get('/admin/datos', 'CoordinadorController@datos')->name('coordinador.datos'); //Tenemos que meterle middleware
Route::get('/admin/estadisticas', 'CoordinadorController@estadisticas')->name('coordinador.estadisticas'); //Tenemos que meterle middleware


//Email
Route::get('/send-mail', 'MailSendController@mailsend');
