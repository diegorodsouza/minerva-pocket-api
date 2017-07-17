<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CentroPonto;

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

        CentroPonto::create($dados);

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
          return view ("auth.localizacao.centroeponto.edit", compact('centroeponto'));

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

      $id = CentroPonto::findOrFail($id);
      $id->update($dados);

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
