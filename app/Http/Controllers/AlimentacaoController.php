<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alimentacao;
use App\Localizacao;

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
      return view ("auth.alimentacao.index", compact('locais'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ("auth.alimentacao.create");
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
          'centro_ponto_id' => $dados['centro']
        );
        $local_id = Localizacao::insertGetId($dadosLoc);

        $dadosAli = array(
          'nome'          => $dados['nome'],
          'funcionamento' => $dados['funcionamento'],
          'preco'         => $dados['preco'],
          'imagem'        => $dados['imagem'],
          'localizacao'   => $local_id
        );
        Alimentacao::create($dadosAli);

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
          $localizacao = Localizacao::findOrFail($alimentacao->localizacao)
          return view ("auth.alimentacao.edit", compact('alimentacao','localizacao'));

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
        'centro_ponto_id' => $dados['centro']
      );

      $local_id = Localizacao::findOrFail($id->localizacao);

      $local_id->update($dadosLoc);

      $dadosAli = array(
        'nome'          => $dados['nome'],
        'funcionamento' => $dados['funcionamento'],
        'preco'         => $dados['preco'],
        'imagem'        => $dados['imagem'],
        'localizacao'   => $local_id
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
      $local_id = Localizacao::findOrFail($id->localizacao);

      $local_id->destroy($id->localizacao);
      $id_delete->destroy($id);

      return redirect()->route("Alimentacao")->with(['success'=>'Local de Alimentação deletado com sucesso.']);
    }
}
