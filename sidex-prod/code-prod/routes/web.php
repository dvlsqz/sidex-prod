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

Route::get('/inicio/{type}', 'ContentController@getHome')->name('home');
Route::post('/inicio/{type}/search', 'ContentController@postUnitSearch')->name('home');


//RUTAS DE Autentificacion
Route::get('/login','ConnectController@getLogin')->name('login');
Route::post('/login','ConnectController@postLogin')->name('login');
Route::get('/logout','ConnectController@getLogout')->name('logout');
/*Route::get('/register','ConnectController@getRegister')->name('register');
Route::post('/register','ConnectController@postRegister')->name('register');
Route::get('/recover','ConnectController@getRecover')->name('recover');
Route::post('/recover','ConnectController@postRecover')->name('recover');
Route::get('/reset','ConnectController@getReset')->name('reset');
Route::post('/reset','ConnectController@postReset')->name('reset');*/

//Module User
Route::get('/account/edit','UserController@getAccountEdit')->name('account_edit');
Route::post('/account/edit/avatar','UserController@postAccountAvatar')->name('account_edit_avatar');
Route::post('/account/edit/password','UserController@postAccountPassword')->name('account_edit_password');
Route::post('/account/edit/info','UserController@postAccountInfo')->name('account_edit_info');

Route::get('/unit/{id}/services/{filtrado}', 'UsetController@getServices')->name('services');
Route::post('/unit/{id}/service/search', 'UsetController@postServiceSearch')->name('fservice_search');
Route::get('/unit/{id}/imprimir-listado','UsetController@getReportExtension')->name('print_list'); 

Route::get('/services/{id}/telephone_extensions', 'UsetController@getTelephoneExtensions')->name('telephone_extensions');
Route::post('/services/{id}/telephone_extension/search', 'UsetController@postTelephoneExtensionSearch')->name('ftelephone_extension_search');

//Ajax API Routers
Route::get('/md/api/load/units/{section}', 'ApiJsController@getUnitsSection');
