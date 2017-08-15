<?php

use Illuminate\Http\Request;
use App\Servico;
use App\ServicoBanco;
use App\ServicoComercio;
use App\ServicoOutro;
use App\ServicoXeroxGrafica;
use App\Localizacao;
use App\CentroPonto;
use App\Transporte;
use App\TransporteLocalizacao;
use App\Alimentacao;
use App\TipoDeComida;
use App\TipoDePagamento;
use App\AlimentacaoTipoPagamento;
use App\AlimentacaoTipoComida;
use App\Academico;
use App\TipoDeAcademico;
use App\Infraestrutura;




/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/academico_api', 'AcademicoController@returnAPI')->name('Academico_API');
Route::get('/servico_api', 'ServicoController@returnAPI')->name('Servico_API');
Route::get('/transporte_api', 'TransporteController@returnAPI')->name('Transporte_API');
Route::get('/alimentacao_api', 'AlimentacaoController@returnAPI')->name('Alimentacao_API');
Route::get('/infraestrutura_api', 'InfraestruturaController@returnAPI')->name('Infraestrutura_API');
