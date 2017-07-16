<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoDeAcademico;

class TipoDeAcademicoController extends Controller
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
      $tiposdeacademicos = TipoDeAcademico::orderBy('id', 'asc')->get();
      return view ("auth.academico.tipodeacademico.index", compact('tiposdeacademicos'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ("auth.academico.tipodeacademico.create");
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

        TipoDeAcademico::create($dados);

        return redirect()->route('TipoDeAcademico')->with(['success'=>'Tipo de Serviço Acadêmico adicionado com sucesso.']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          $tipodeacademico = TipoDeAcademico::findOrFail($id);
          return view ("auth.academico.tipodeacademico.edit", compact('tipodeacademico'));

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

      $id = TipoDeAcademico::findOrFail($id);
      $id->update($dados);

      return redirect()->route("TipoDeAcademico")->with(['success'=>'Tipo de Serviço Acadêmico editado com sucesso.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $id_delete = TipoDeAcademico::findOrFail($id);
      $id_delete->destroy($id);

      return redirect()->route("TipoDeAcademico")->with(['success'=>'Tipo de Serviço Acadêmico deletado com sucesso.']);
    }
}
