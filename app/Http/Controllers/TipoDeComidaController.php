<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoDeComida;

class TipoDeComidaController extends Controller
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
      $tiposdecomidas = TipoDeComida::orderBy('id', 'asc')->get();
      return view ("auth.alimentacao.tipodecomida.index", compact('tiposdecomidas'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ("auth.alimentacao.tipodecomida.create");
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

        TipoDeComida::create($dados);

        return redirect()->route('TipoDeComida')->with(['success'=>'Tipo de Serviço de Comida adicionado com sucesso.']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          $tipodecomida = TipoDeComida::findOrFail($id);
          return view ("auth.alimentacao.tipodecomida.edit", compact('tipodecomida'));

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

      $id = TipoDeComida::findOrFail($id);
      $id->update($dados);

      return redirect()->route("TipoDeComida")->with(['success'=>'Tipo de Serviço de Comida editado com sucesso.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $id_delete = TipoDeComida::findOrFail($id);
      $id_delete->destroy($id);

      return redirect()->route("TipoDeComida")->with(['success'=>'Tipo de Serviço de Comida deletado com sucesso.']);
    }
}
