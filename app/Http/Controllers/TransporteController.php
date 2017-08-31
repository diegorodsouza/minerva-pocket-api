<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transporte;
use App\Localizacao;
use App\CentroPonto;
use App\TransporteLocalizacao;
use App\ImgurLink;
use DB;

class TransporteController extends Controller
{

    public function __construct()
    {
      if (\Route::currentRouteName() == 'Transporte_API'){

      } else {
         $this->middleware('auth');
      }
    }

    public function returnAPI(){

      header("Access-Control-Allow-Origin: *");

      $dataTransportesInterno = array();
      $dataTransportesExterno = array();
      $dataTransportes = array();

      $transportesInternos = Transporte::where('tipo','Interno')->orderBy('id', 'asc')->get();

      foreach($transportesInternos as $transporte){
        $pontos = DB::table('centro_ponto')->where('tipo', 'Ponto')->get();
        $transportes_localizacoes = TransporteLocalizacao::where('transporte_id', $id)->get();
        foreach ($pontos as $ponto){
          foreach ($transportes_localizacoes as $transporte_localizacao){
            if($ponto->id == $transporte_localizacao->localizacao_id){
              $pontoLoc = array(
                // 'latitude' => $local->latitude,
                // 'longitude'=> $local->longitude,
                'nome'     => $ponto->descricao
              );
              array_push($pontosQuePassa, $pontoLoc);
            }
          }
        }

        $transporte->imagem = ImgurLink::transformImgurLink($transporte->imagem);
        $tudoTransporte = array([
          'id'            => $transporte->id,
          'linha'         => $transporte->linha,
          'preco'         => $transporte->preco,
          'tipo'          => $transporte->tipo,
          'funcionamento' => $transporte->funcionamento,
          'imagem'        => $transporte->imagem,
          'observacao'    => $transporte->observacao,
          'pontosQuePassa'=> $pontosQuePassa
          ]);

          array_push($dataTransportesInterno, $tudoTransporte);
        }
      array_push($dataTransportes, $dataTransportesInterno);

      $transportesExternos = Transporte::where('tipo','Externo')->orderBy('id', 'asc')->get();

      foreach($transportesExternos as $transporte){
        $transloctupla = TransporteLocalizacao::where('transporte_id', $transporte->id)->get();
    
        $pontosQuePassa = array();
        foreach($transloctupla as $passa){
          $local = Localizacao::find($passa->localizacao_id);
          $ponto = CentroPonto::find($local->centro_ponto_id);
          $pontoLoc = array(
            'latitude' => $local->latitude,
            'longitude'=> $local->longitude,
            'nome'     => $ponto->descricao
          );
          array_push($pontosQuePassa, $pontoLoc);          
        }

        $transporte->imagem = ImgurLink::transformImgurLink($transporte->imagem);
        $tudoTransporte = array([
          'id'            => $transporte->id,
          'linha'         => $transporte->linha,
          'preco'         => $transporte->preco,
          'tipo'          => $transporte->tipo,
          'funcionamento' => $transporte->funcionamento,
          'imagem'        => $transporte->imagem,
          'observacao'    => $transporte->observacao,
          'pontosQuePassa'=> $pontosQuePassa
          ]);

          array_push($dataTransportesExterno, $tudoTransporte);
        }
      array_push($dataTransportes, $dataTransportesExterno);

      return $dataTransportes;
    }


    public function index()
    {
      $transportes = Transporte::orderBy('linha', 'asc')->get();
      return view ("auth.transporte.index", compact(['transportes']));

    }

    public function create()
    {
        $pontos = DB::table('centro_ponto')->where('tipo', 'Ponto')->get();
        return view ("auth.transporte.create",compact(['pontos']));
    }


    public function store(Request $request)
    {
        $dados = $request->all();

        // TRANSPORTE

        $dadosTra = array(
          'linha'         => $dados['linha'],
          'funcionamento' => $dados['funcionamento'],
          'preco'         => $dados['preco'],
          'imagem'        => $dados['imagem'],
          'observacao'    => $dados['observacao'],
          'tipo'          => $dados['tipo']
        );
        $transporte_id = Transporte::insertGetId($dadosTra);

        // LOCALIZAÇÃO

        $dadosLoc = array(
          'pontos' => $dados['ponto']
        );

        for ($id=0; $id < count($dadosLoc['pontos']); $id++) {
          $tupla = array(
            'transporte_id'  => $transporte_id,
            'localizacao_id' => $dadosLoc['pontos'][$id]
          );
          TransporteLocalizacao::create($tupla);
        }

        return redirect()->route('Transporte')->with(['success'=>'Linha de Ônibus adicionada com sucesso.']);
    }


    public function edit($id)
    {
          $transporte = Transporte::findOrFail($id);
          $pontos = DB::table('centro_ponto')->where('tipo', 'Ponto')->get();
          $transportes_localizacoes = TransporteLocalizacao::where('transporte_id', $id)->get();
          return view ("auth.transporte.edit", compact(['transporte','pontos','transportes_localizacoes']));

    }


    public function update(Request $request, $id)
    {
      $dados = $request->all();

      $transporte = Transporte::findOrFail($id);

      // TRANSPORTE

      $dadosTra = array(
        'linha'         => $dados['linha'],
        'funcionamento' => $dados['funcionamento'],
        'preco'         => $dados['preco'],
        'imagem'        => $dados['imagem'],
        'observacao'    => $dados['observacao'],
        'tipo'          => $dados['tipo']
      );

      $transporte->update($dadosTra);

      // LOCALIZAÇÃO

      $tuplas_localizacao = TransporteLocalizacao::where("transporte_id", $id)->delete();

      $dadosLoc = array(
        'pontos' => $dados['ponto']
      );

      for ($id=0; $id < count($dadosLoc['pontos']); $id++) {
        $tupla = array(
          'transporte_id'  => $transporte->id,
          'localizacao_id' => $dadosLoc['pontos'][$id]
        );
        TransporteLocalizacao::create($tupla);
      }

      return redirect()->route("Transporte")->with(['success'=>'Linha de Ônibus editada com sucesso.']);
    }


    public function destroy($id)
    {
      $transporte = Transporte::findOrFail($id);
      $tuplas_localizacao = TransporteLocalizacao::where("transporte_id", $transporte->id)->delete();
      $transporte->destroy($id);

      return redirect()->route("Transporte")->with(['success'=>'Linha de Ônibus deletada com sucesso.']);
    }
}
