<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoDePagamento;

class TipoDePagamentoController extends Controller
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
      $tiposdepagamentos = TipoDePagamento::orderBy('id', 'asc')->get();
      return view ("auth.alimentacao.tipodepagamento.index", compact('tiposdepagamentos'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ("auth.alimentacao.tipodepagamento.create");
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

        TipoDePagamento::create($dados);

        return redirect("/tipodepagamento")->with(['success'=>'Forma de Pagamento adicionada com sucesso']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          $tipodepagamento = TipoDePagamento::findOrFail($id);
          return view ("auth.alimentacao.tipodepagamento.edit", compact('tipodepagamento'));

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

      $id = TipoDePagamento::findOrFail($id);
      $id->update($dados);

      return redirect("/tipodepagamento")->with(['success'=>'Forma de Pagamento editada com sucesso']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
