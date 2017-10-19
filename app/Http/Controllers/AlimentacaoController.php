<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alimentacao;
use App\Localizacao;
use App\CentroPonto;
use App\TipoDeComida;
use App\TipoDePagamento;
use App\AlimentacaoTipoPagamento;
use App\AlimentacaoTipoComida;
use App\ImgurLink;
use DB;

class AlimentacaoController extends Controller
{

    public function __construct()
    {
      if (\Route::currentRouteName() == 'Alimentacao_API'){

      } else {
         $this->middleware('auth');
      }
    }

    public function returnAPI(){

      header("Access-Control-Allow-Origin: *");

      $dataAlimentacaos = array();
      $alimentacaos = Alimentacao::orderBy('id', 'asc')->get();

      foreach ($alimentacaos as $alimentacao) {
        $alimentacao_tipos_pagamentos = AlimentacaoTipoPagamento::where('alimentacao_id', $alimentacao->id)->get();
        $alimentacao_tipos_comidas = AlimentacaoTipoComida::where('alimentacao_id', $alimentacao->id)->get();

        $tiposPagamento = array();
        $tiposComida = array();

        foreach ($alimentacao_tipos_pagamentos as $alimentacao_tipo_pagamento){
          $tipo = TipoDePagamento::find($alimentacao_tipo_pagamento->tipo_pagamento_id);
          $tipoNome = " " + $tipo->descricao;
          array_push($tiposPagamento, $tipoNome);
        }
        foreach ($alimentacao_tipos_comidas as $alimentacao_tipo_comida){
          $tipo = TipoDeComida::find($alimentacao_tipo_comida->tipo_comida_id);
          $tipoNome = " " + $tipo->descricao;
          array_push($tiposComida, $tipoNome);
        }

        $localizacao = Localizacao::findOrFail($alimentacao->localizacao);
        $centro = CentroPonto::findOrFail($localizacao->centro_ponto_id);

        $alimentacao_localizacao = array([
          'latitude'  => $localizacao->latitude,
          'longitude' => $localizacao->longitude,
          'centro'    => $centro->descricao
          ]);

        $alimentacao->imagem = ImgurLink::transformImgurLink($alimentacao->imagem);
        $tudoComida = array([
          'id'               => $alimentacao->id,
          'nome'             => $alimentacao->nome,
          'preco'            => $alimentacao->preco,
          'funcionamento'    => $alimentacao->funcionamento,
          'localizacao'      => $alimentacao_localizacao,
          'imagem'           => $alimentacao->imagem,
          'tipo_de_comida'   => $tiposComida,
          'tipo_de_pagamento'=> $tiposPagamento
          ]);

          array_push($dataAlimentacaos, $tudoComida);
        }

        return $dataAlimentacaos;
    }


    public function index()
    {
      $locais = Alimentacao::orderBy('nome', 'asc')->get();
      $tiposdepagamentos = TipoDePagamento::orderBy('id', 'asc')->get();
      $tiposdecomidas = TipoDeComida::orderBy('id', 'asc')->get();
      return view ("auth.alimentacao.index", compact(['locais','tiposdecomidas','tiposdepagamentos']));

    }


    public function create()
    {
        $centros = DB::table('centro_ponto')->where('tipo', 'Centro')->get();
        $tiposdepagamentos = TipoDePagamento::orderBy('descricao', 'asc')->get();
        $tiposdecomidas = TipoDeComida::orderBy('descricao', 'asc')->get();
        return view ("auth.alimentacao.create",compact(['centros','tiposdecomidas','tiposdepagamentos']));
    }


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
