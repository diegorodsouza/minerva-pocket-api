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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/tipodepagamento', 'TipoDePagamentoController@index')->name('TipoDePagamento');
Route::get('/create_tipodepagamento', 'TipoDePagamentoController@create')->name('CreateTipoDePagamento');
Route::post('/create_tipodepagamento', 'TipoDePagamentoController@store')->name('StoreTipoDePagamento');
Route::get('/edit_tipodepagamento/{id}', 'TipoDePagamentoController@edit')->name('EditTipoDePagamento');
Route::put('/edit_tipodepagamento/{id}', 'TipoDePagamentoController@update')->name('UpdateTipoDePagamento');
Route::delete('/destroy_tipodepagamento/{id}', 'TipoDePagamentoController@destroy')->name('DestroyTipoDePagamento');

Route::get('/tipodecomida', 'TipoDeComidaController@index')->name('TipoDeComida');
Route::get('/create_tipodecomida', 'TipoDeComidaController@create')->name('CreateTipoDeComida');
Route::post('/create_tipodecomida', 'TipoDeComidaController@store')->name('StoreTipoDeComida');
Route::get('/edit_tipodecomida/{id}', 'TipoDeComidaController@edit')->name('EditTipoDeComida');
Route::put('/edit_tipodecomida/{id}', 'TipoDeComidaController@update')->name('UpdateTipoDeComida');
Route::delete('/destroy_tipodecomida/{id}', 'TipoDeComidaController@destroy')->name('DestroyTipoDeComida');
