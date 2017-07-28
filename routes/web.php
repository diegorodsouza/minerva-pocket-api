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

Route::get('/academico', 'AcademicoController@index')->name('Academico');
Route::get('/create_academico', 'AcademicoController@create')->name('CreateAcademico');
Route::post('/create_academico', 'AcademicoController@store')->name('StoreAcademico');
Route::get('/edit_academico/{id}', 'AcademicoController@edit')->name('EditAcademico');
Route::put('/edit_academico/{id}', 'AcademicoController@update')->name('UpdateAcademico');
Route::delete('/destroy_academico/{id}', 'AcademicoController@destroy')->name('DestroyAcademico');

Route::get('/transporte', 'TransporteController@index')->name('Transporte');
Route::get('/create_transporte', 'TransporteController@create')->name('CreateTransporte');
Route::post('/create_transporte', 'TransporteController@store')->name('StoreTransporte');
Route::get('/edit_transporte/{id}', 'TransporteController@edit')->name('EditTransporte');
Route::put('/edit_transporte/{id}', 'TransporteController@update')->name('UpdateTransporte');
Route::delete('/destroy_transporte/{id}', 'TransporteController@destroy')->name('DestroyTransporte');

Route::get('/servico_banco', 'ServicoController@indexBanco')->name('ServicoBanco');
Route::get('/create_servico_banco', 'ServicoController@createBanco')->name('CreateServicoBanco');
Route::post('/create_servico_banco', 'ServicoController@storeBanco')->name('StoreServicoBanco');
Route::get('/edit_servico_banco/{id}', 'ServicoController@editBanco')->name('EditServicoBanco');
Route::put('/edit_servico_banco/{id}', 'ServicoController@updateBanco')->name('UpdateServicoBanco');
Route::delete('/destroy_servico_banco/{id}', 'ServicoController@destroyBanco')->name('DestroyServicoBanco');

Route::get('/servico_comercio', 'ServicoController@indexComercio')->name('ServicoComercio');
Route::get('/create_servico_comercio', 'ServicoController@createComercio')->name('CreateServicoComercio');
Route::post('/create_servico_comercio', 'ServicoController@storeComercio')->name('StoreServicoComercio');
Route::get('/edit_servico_comercio/{id}', 'ServicoController@editComercio')->name('EditServicoComercio');
Route::put('/edit_servico_comercio/{id}', 'ServicoController@updateComercio')->name('UpdateServicoComercio');
Route::delete('/destroy_servico_comercio/{id}', 'ServicoController@destroyComercio')->name('DestroyServicoComercio');

Route::get('/servico_outro', 'ServicoController@indexOutro')->name('ServicoOutro');
Route::get('/create_servico_outro', 'ServicoController@createOutro')->name('CreateServicoOutro');
Route::post('/create_servico_outro', 'ServicoController@storeOutro')->name('StoreServicoOutro');
Route::get('/edit_servico_outro/{id}', 'ServicoController@editOutro')->name('EditServicoOutro');
Route::put('/edit_servico_outro/{id}', 'ServicoController@updateOutro')->name('UpdateServicoOutro');
Route::delete('/destroy_servico_outro/{id}', 'ServicoController@destroyOutro')->name('DestroyServicoOutro');

Route::get('/servico_xerox_grafica', 'ServicoController@indexXeroxGrafica')->name('ServicoXeroxGrafica');
Route::get('/create_servico_xerox_grafica', 'ServicoController@createXeroxGrafica')->name('CreateServicoXeroxGrafica');
Route::post('/create_servico_xerox_grafica', 'ServicoController@storeXeroxGrafica')->name('StoreServicoXeroxGrafica');
Route::get('/edit_servico_xerox_grafica/{id}', 'ServicoController@editXeroxGrafica')->name('EditServicoXeroxGrafica');
Route::put('/edit_servico_xerox_grafica/{id}', 'ServicoController@updateXeroxGrafica')->name('UpdateServicoXeroxGrafica');
Route::delete('/destroy_servico_xerox_grafica/{id}', 'ServicoController@destroyXeroxGrafica')->name('DestroyServicoXeroxGrafica');
