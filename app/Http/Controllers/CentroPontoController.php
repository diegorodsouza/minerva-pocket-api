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
          'created_at'      => \DB::raw('CURRENT_TIMESTAMP')
        );
        $centro_id = CentroPonto::insertGetId($dadosCen);

        $dadosLoc = array(
          'latitude'        => $dados['latitude'],
          'longitude'       => $dados['longitude'],
          'centro_ponto_id' => $centro_id
        );
        Localizacao::create($dadosLoc);

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
          $localizacao = \DB::table('localizacao')->where('created_at', '>=', $centroeponto->created_at)->first();
          dd($localizacao);
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

      $dadosCen = array(
        'descricao'       => $dados['descricao']
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
      $id_delete->destroy($id);

      return redirect()->route("CentroPonto")->with(['success'=>'Centro ou Ponto de Ônibus deletado com sucesso.']);
    }
}
