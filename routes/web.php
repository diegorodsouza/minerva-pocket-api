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

Route::get('/tipodeacademico', 'TipoDeAcademicoController@index')->name('TipoDeAcademico');
Route::get('/create_tipodeacademico', 'TipoDeAcademicoController@create')->name('CreateTipoDeAcademico');
Route::post('/create_tipodeacademico', 'TipoDeAcademicoController@store')->name('StoreTipoDeAcademico');
Route::get('/edit_tipodeacademico/{id}', 'TipoDeAcademicoController@edit')->name('EditTipoDeAcademico');
Route::put('/edit_tipodeacademico/{id}', 'TipoDeAcademicoController@update')->name('UpdateTipoDeAcademico');
Route::delete('/destroy_tipodeacademico/{id}', 'TipoDeAcademicoController@destroy')->name('DestroyTipoDeAcademico');

Route::get('/centroeponto', 'CentroPontoController@index')->name('CentroPonto');
Route::get('/create_centroeponto', 'CentroPontoController@create')->name('CreateCentroPonto');
Route::post('/create_centroeponto', 'CentroPontoController@store')->name('StoreCentroPonto');
Route::get('/edit_centroeponto/{id}', 'CentroPontoController@edit')->name('EditCentroPonto');
Route::put('/edit_centroeponto/{id}', 'CentroPontoController@update')->name('UpdateCentroPonto');
Route::delete('/destroy_centroeponto/{id}', 'CentroPontoController@destroy')->name('DestroyCentroPonto');

Route::get('/alimentacao', 'AlimentacaoController@index')->name('Alimentacao');
Route::get('/create_alimentacao', 'AlimentacaoController@create')->name('CreateAlimentacao');
Route::post('/create_alimentacao', 'AlimentacaoController@store')->name('StoreAlimentacao');
Route::get('/edit_alimentacao/{id}', 'AlimentacaoController@edit')->name('EditAlimentacao');
Route::put('/edit_alimentacao/{id}', 'AlimentacaoController@update')->name('UpdateAlimentacao');
Route::delete('/destroy_alimentacao/{id}', 'AlimentacaoController@destroy')->name('DestroyAlimentacao');
