<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CentroPonto;
use App\Localizacao;

class CentroPontoController extends Controller
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
      $centrosepontos = CentroPonto::orderBy('id', 'asc')->get();
      return view ("auth.localizacao.centroeponto.index", compact('centrosepontos'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ("auth.localizacao.centroeponto.create");
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

        $dadosCen = array(
          'descricao'       => $dados['descricao'],
          'created_at'      => \DB::raw('CURRENT_TIMESTAMP'),
          'loc_id'          => null,
          'tipo'            => $dados['tipo']
        );
        $centro_id = CentroPonto::insertGetId($dadosCen);

        $dadosLoc = array(
          'latitude'        => $dados['latitude'],
          'longitude'       => $dados['longitude'],
          'centro_ponto_id' => $centro_id,
          'created_at'      => \DB::raw('CURRENT_TIMESTAMP')
        );
        $loc_id = Localizacao::insertGetId($dadosLoc);

        $centro = CentroPonto::findOrFail($centro_id);
        $dadoCen2 = array(
          'loc_id'          => $loc_id
        );
        $centro->update($dadoCen2);


        return redirect()->route('CentroPonto')->with(['success'=>'Centro ou Ponto de Ônibus adicionado com sucesso.']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          $centroeponto = CentroPonto::findOrFail($id);
          $localizacao = Localizacao::findOrFail($centroeponto->loc_id);
          return view ("auth.localizacao.centroeponto.edit", compact('centroeponto','localizacao'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $localizacao_id)
    {
      $dados = $request->all();

      $local = Localizacao::findOrFail($localizacao_id);
      $centro = CentroPonto::findOrFail($local->centro_ponto_id);

      $centro_id = $centro->id;

      $dadosLoc = array(
        'latitude'        => $dados['latitude'],
        'longitude'       => $dados['longitude'],
        'centro_ponto_id' => $centro_id
      );
      $local->update($dadosLoc);

      $dadosCen = array(
        'descricao'       => $dados['descricao'],
        'tipo'            => $dados['tipo']
      );

      $centro->update($dadosCen);

      return redirect()->route("CentroPonto")->with(['success'=>'Centro ou Ponto de Ônibus editado com sucesso.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $id_delete = CentroPonto::findOrFail($id);
      $local = Localizacao::findOrFail($id_delete->loc_id);

      $local->destroy($id_delete->loc_id);
      $id_delete->destroy($id);

      return redirect()->route("CentroPonto")->with(['success'=>'Centro ou Ponto de Ônibus deletado com sucesso.']);
    }
}
