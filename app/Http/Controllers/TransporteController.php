<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transporte;
use App\Localizacao;
use App\CentroPonto;
use App\TransporteLocalizacao;
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

      $dataTransportes = array();
      $transportes = Transporte::orderBy('id', 'asc')->get();
      $pontos = CentroPonto::where('tipo', 'Ponto')->get();

      foreach ($transportes as $transporte) {
        $transportes_localizacoes = TransporteLocalizacao::where('transporte_id', $transporte->id)->get();

        foreach ($transportes_localizacoes as $transporte_localizacao){
          $ponto = CentroPonto::findOrFail($transporte_localizacao->centro_ponto_id);
          $pontoNome = $ponto->descricao;
          array_push($pontosQuePassa, $pontoNome);
        }

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

          array_push($dataTransportes, $tudoTransporte);
        }

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          $transporte = Transporte::findOrFail($id);
          $pontos = DB::table('centro_ponto')->where('tipo', 'Ponto')->get();
          $transportes_localizacoes = TransporteLocalizacao::where('transporte_id', $id)->get();
          return view ("auth.transporte.edit", compact(['transporte','pontos','transportes_localizacoes']));

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $transporte = Transporte::findOrFail($id);
      $tuplas_localizacao = TransporteLocalizacao::where("transporte_id", $transporte->id)->delete();
      $transporte->destroy($id);

      return redirect()->route("Transporte")->with(['success'=>'Linha de Ônibus deletada com sucesso.']);
    }
}
