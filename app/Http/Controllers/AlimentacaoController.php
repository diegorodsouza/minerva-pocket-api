<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alimentacao;
use App\Localizacao;
use App\CentroPonto;
use App\TipoDeComida;
use App\TipoDePagamento;
use DB;

class AlimentacaoController extends Controller
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

    public function index()
    {
      $locais = Alimentacao::orderBy('id', 'asc')->get();
      $tiposdepagamentos = TipoDePagamento::orderBy('id', 'asc')->get();
      $tiposdecomidas = TipoDeComida::orderBy('id', 'asc')->get();
      return view ("auth.alimentacao.index", compact(['locais','tiposdecomidas','tiposdepagamentos']));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $centros = DB::table('centro_ponto')->where('tipo', 'Centro')->get();
        $tiposdepagamentos = TipoDePagamento::orderBy('id', 'asc')->get();
        $tiposdecomidas = TipoDeComida::orderBy('id', 'asc')->get();
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

        $dadosLoc = array(
          'latitude'        => $dados['latitude'],
          'longitude'       => $dados['longitude'],
          'centro_ponto_id' => intval($dados['centro'])
        );
        $local_id = Localizacao::insertGetId($dadosLoc);
        $local = Localizacao::findOrFail($local_id);
        $dadosAli = array(
          'nome'          => $dados['nome'],
          'funcionamento' => $dados['funcionamento'],
          'preco'         => $dados['preco'],
          'imagem'        => $dados['imagem'],
          'localizacao'   => $local->centro_ponto_id
        );
        $alimentacao_id = Alimentacao::insertGetId($dadosAli);

        $dadosPag = array(
          'tiposdepagamentos' => $dados['tipodepagamento']
        );

        dd($dadosPag);

        foreach ($dadosPag as $dadoPag) {
          dd($dadoPag);
          $tupla = array(
            'alimentacao_id'    => $alimentacao_id,
            'tipo_pagamento_id' => $dadoPag
          );
          TipoDePagamento::create($tupla);
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
          return view ("auth.alimentacao.edit", compact(['alimentacao','localizacao','centros']));

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

      $id = Alimentacao::findOrFail($id);

      $dadosLoc = array(
        'latitude'        => $dados['latitude'],
        'longitude'       => $dados['longitude'],
        'centro_ponto_id' => intval($dados['centro'])
      );

      $local = Localizacao::findOrFail($id->localizacao);

      $local->update($dadosLoc);

      $dadosAli = array(
        'nome'          => $dados['nome'],
        'funcionamento' => $dados['funcionamento'],
        'preco'         => $dados['preco'],
        'imagem'        => $dados['imagem'],
        'localizacao'   => $local->centro_ponto_id
      );

      $id->update($dadosAli);

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
      $id_delete = Alimentacao::findOrFail($id);
      $local = Localizacao::findOrFail($id_delete->localizacao);
      $local_id = $local->id;
      $local->destroy($local->id);
      $id_delete->destroy($id);

      return redirect()->route("Alimentacao")->with(['success'=>'Local de Alimentação deletado com sucesso.']);
    }
}
