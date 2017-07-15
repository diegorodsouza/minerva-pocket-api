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
