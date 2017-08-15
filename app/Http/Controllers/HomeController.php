<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Academico;
use App\Alimentacao;
use App\TipoDeAcademico;
use App\TipoDeComida;
use App\TipoDePagamento;
use App\Localizacao;
use App\CentroPonto;
use App\ServicoBanco;
use App\ServicoComercio;
use App\ServicoOutro;
use App\ServicoXeroxGrafica;
use App\Transporte;
use App\Infraestrutura;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $academicos = Academico::orderBy('nome', 'asc')->count();
      $tiposdeacademicos = TipoDeAcademico::orderBy('id', 'asc')->count();
      $centros = CentroPonto::where('tipo', 'Centro')->count();
      $pontos = CentroPonto::where('tipo', 'Ponto')->count();
      $alimentacao = Alimentacao::orderBy('nome', 'asc')->count();
      $tiposdecomidas = TipoDeComida::orderBy('id', 'asc')->count();
      $tiposdepagamentos = TipoDePagamento::orderBy('id', 'asc')->count();
      $comercios = ServicoComercio::orderBy('id', 'asc')->count();
      $caixas = ServicoBanco::where('tipo', 'Caixa Eletrônico')->orderBy('id', 'asc')->count();
      $agencias = ServicoBanco::where('tipo', 'Agência')->orderBy('id', 'asc')->count();
      $outros = ServicoOutro::orderBy('id', 'asc')->count();
      $xerox_graficas = ServicoXeroxGrafica::orderBy('id', 'asc')->count();
      $transportes = Transporte::orderBy('linha', 'asc')->count();
      $infras = Infraestrutura::orderBy('name', 'asc')->count();

        return view('home', compact(['academicos','tiposdeacademicos','centros',
                                     'pontos','alimentacao','tiposdecomidas',
                                     'tiposdepagamentos','comercios','caixas',
                                     'agencias','outros','xerox_graficas','transportes']));
    }
}
