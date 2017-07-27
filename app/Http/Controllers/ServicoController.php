<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Servico;
use App\ServicoBanco;
use App\ServicoComercio;
use App\ServicoOutro;
use App\ServicoXeroxGrafica;
use App\Localizacao;
use DB;

class ServicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
         $this->middleware('auth');
    }

    public function indexBanco()
    {
      $bancos = ServicoBanco::orderBy('nome', 'asc')->get();
      $servicos = Servico::orderBy('id', 'asc')->get();
      return view ("auth.servico.banco.index", compact(['bancos','servicos']));

    }

    public function indexComercio()
    {
      $comercios = ServicoComercio::orderBy('nome', 'asc')->get();
      $servicos = Servico::orderBy('id', 'asc')->get();
      return view ("auth.servico.comercio.index", compact(['comercios','servicos']));

    }

    public function indexOutro()
    {
      $outros = ServicoOutro::orderBy('nome', 'asc')->get();
      $servicos = Servico::orderBy('id', 'asc')->get();
      return view ("auth.servico.outro.index", compact(['outros','servicos']));

    }

    public function indexOutro()
    {
      $xerox_graficas = ServicoXeroxGrafica::orderBy('nome', 'asc')->get();
      $servicos = Servico::orderBy('id', 'asc')->get();
      return view ("auth.servico.xerox_grafica.index", compact(['xerox_graficas','servicos']));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createBanco()
    {
        $centros = DB::table('centro_ponto')->where('tipo', 'Centro')->get();
        $tiposdepagamentos = TipoDePagamento::orderBy('descricao', 'asc')->get();
        $tiposdecomidas = TipoDeComida::orderBy('descricao', 'asc')->get();
        return view ("auth.alimentacao.create",compact(['centros','tiposdecomidas','tiposdepagamentos']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dados = $request->all();

        // LOCALIZAÇÃO

        $dadosLoc = array(
          'latitude'        => $dados['latitude'],
          'longitude'       => $dados['longitude'],
          'centro_ponto_id' => intval($dados['centro'])
        );
        $local_id = Localizacao::insertGetId($dadosLoc);

        // ALIMENTAÇÃO

        $dadosAli = array(
          'nome'          => $dados['nome'],
          'funcionamento' => $dados['funcionamento'],
          'preco'         => $dados['preco'],
          'imagem'        => $dados['imagem'],
          'localizacao'   => $local_id
        );
        $alimentacao_id = Alimentacao::insertGetId($dadosAli);

        // FORMA DE PAGAMENTO

        $dadosPag = array(
          'tiposdepagamentos' => $dados['tipodepagamento']
        );

        for ($id=0; $id < count($dadosPag['tiposdepagamentos']); $id++) {
          $tupla1 = array(
            'alimentacao_id'    => $alimentacao_id,
            'tipo_pagamento_id' => $dadosPag['tiposdepagamentos'][$id]
          );
          AlimentacaoTipoPagamento::create($tupla1);
        }

        // TIPO DE COMIDA

        $dadosCom = array(
          'tiposdecomidas' => $dados['tipodecomida']
        );

        for ($id=0; $id < count($dadosCom['tiposdecomidas']); $id++) {
          $tupla2 = array(
            'alimentacao_id' => $alimentacao_id,
            'tipo_comida_id' => $dadosCom['tiposdecomidas'][$id]
          );
          AlimentacaoTipoComida::create($tupla2);
        }

        return redirect()->route('Alimentacao')->with(['success'=>'Local de Alimentação adicionado com sucesso.']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          $alimentacao = Alimentacao::findOrFail($id);
          $localizacao = Localizacao::findOrFail($alimentacao->localizacao);
          $centros = DB::table('centro_ponto')->where('tipo', 'Centro')->get();
          $tiposdepagamentos = TipoDePagamento::orderBy('descricao', 'asc')->get();
          $tiposdecomidas = TipoDeComida::orderBy('descricao', 'asc')->get();
          $alimentacao_tipos_pagamentos = AlimentacaoTipoPagamento::where('alimentacao_id', $id)->get();
          $alimentacao_tipos_comidas = AlimentacaoTipoComida::where('alimentacao_id', $id)->get();
          return view ("auth.alimentacao.edit", compact(['alimentacao','localizacao','centros',
                                                        'tiposdepagamentos','tiposdecomidas',
                                                        'alimentacao_tipos_pagamentos',
                                                        'alimentacao_tipos_comidas']));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $dados = $request->all();

      $alimentacao = Alimentacao::findOrFail($id);

      // LOCALIZAÇÃO

      $dadosLoc = array(
        'latitude'        => $dados['latitude'],
        'longitude'       => $dados['longitude'],
        'centro_ponto_id' => intval($dados['centro'])
      );

      $local = Localizacao::findOrFail($alimentacao->localizacao);

      $local->update($dadosLoc);

      // ALIMENTAÇÃO

      $dadosAli = array(
        'nome'          => $dados['nome'],
        'funcionamento' => $dados['funcionamento'],
        'preco'         => $dados['preco'],
        'imagem'        => $dados['imagem'],
        'localizacao'   => $local->id
      );

      $alimentacao->update($dadosAli);

      // FORMA DE PAGAMENTO

      $tuplas_pagamento = AlimentacaoTipoPagamento::where("alimentacao_id", $id)->delete();

      $dadosPag = array(
        'tiposdepagamentos' => $dados['tipodepagamento']
      );

      for ($id=0; $id < count($dadosPag['tiposdepagamentos']); $id++) {
        $tupla1 = array(
          'alimentacao_id'    => $alimentacao->id,
          'tipo_pagamento_id' => $dadosPag['tiposdepagamentos'][$id]
        );
        AlimentacaoTipoPagamento::create($tupla1);
      }

      // TIPO DE COMIDA

      $tuplas_comida = AlimentacaoTipoComida::where("alimentacao_id", $alimentacao->id)->delete();

      $dadosCom = array(
        'tiposdecomidas' => $dados['tipodecomida']
      );

      for ($id=0; $id < count($dadosCom['tiposdecomidas']); $id++) {
        $tupla2 = array(
          'alimentacao_id' => $alimentacao->id,
          'tipo_comida_id' => $dadosCom['tiposdecomidas'][$id]
        );
        AlimentacaoTipoComida::create($tupla2);
      }

      return redirect()->route("Alimentacao")->with(['success'=>'Local de Alimentação editado com sucesso.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $alimentacao = Alimentacao::findOrFail($id);
      $tupla_localizacao = Localizacao::where("id", $alimentacao->localizacao)->delete();
      $tuplas_pagamento = AlimentacaoTipoPagamento::where("alimentacao_id", $alimentacao->id)->delete();
      $tuplas_comida = AlimentacaoTipoComida::where("alimentacao_id", $alimentacao->id)->delete();
      $alimentacao->destroy($id);

      return redirect()->route("Alimentacao")->with(['success'=>'Local de Alimentação deletado com sucesso.']);
    }
}
