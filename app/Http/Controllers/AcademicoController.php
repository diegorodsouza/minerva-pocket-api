<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Academico;
use App\Localizacao;
use App\CentroPonto;
use App\TipoDeAcademico;
use DB;

class AcademicoController extends Controller
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
      $academicos = Academico::orderBy('nome', 'asc')->get();
      $tiposdeacademicos = TipoDeAcademico::orderBy('id', 'asc')->get();
      return view ("auth.academico.index", compact(['academicos','tiposdeacademicos']));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $centros = DB::table('centro_ponto')->where('tipo', 'Centro')->get();
        $tiposdeacademicos = TipoDeAcademico::orderBy('descricao', 'asc')->get();
        return view ("auth.academico.create",compact(['centros','tiposdeacademicos']));
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

        // LOCALIZAÇÃO

        $dadosLoc = array(
          'latitude'        => $dados['latitude'],
          'longitude'       => $dados['longitude'],
          'centro_ponto_id' => intval($dados['centro'])
        );
        $local_id = Localizacao::insertGetId($dadosLoc);

        // ACADEMICO

        $dadosAca = array(
          'nome'          => $dados['nome'],
          'funcionamento' => $dados['funcionamento'],
          'imagem'        => $dados['imagem'],
          'observacao'    => $dados['observacao'],
          'contato'       => $dados['contato'],
          'localizacao'   => $local_id,
          'tipo'          => intval($dados['tipo'])
        );
        Academico::create($dadosAca);

        return redirect()->route('Academico')->with(['success'=>'Serviço Acadêmico adicionado com sucesso.']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          $academico = Academico::findOrFail($id);
          $localizacao = Localizacao::findOrFail($academico->localizacao);
          $centros = DB::table('centro_ponto')->where('tipo', 'Centro')->get();
          $tiposdeacademicos = TipoDeAcademico::orderBy('descricao', 'asc')->get();
          return view ("auth.academico.edit", compact(['academico','localizacao','centros',
                                                       'tiposdeacademicos']));

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

      $academico = Academico::findOrFail($id);

      // LOCALIZAÇÃO

      $dadosLoc = array(
        'latitude'        => $dados['latitude'],
        'longitude'       => $dados['longitude'],
        'centro_ponto_id' => intval($dados['centro'])
      );

      $local = Localizacao::findOrFail($academico->localizacao);

      $local->update($dadosLoc);

      // ACADEMICO

      $dadosAca = array(
        'nome'          => $dados['nome'],
        'funcionamento' => $dados['funcionamento'],
        'imagem'        => $dados['imagem'],
        'observacao'    => $dados['observacao'],
        'contato'       => $dados['contato'],
        'localizacao'   => $local->id,
        'tipo'          => intval($dados['tipo'])
      );

      $academico->update($dadosAca);

      return redirect()->route("Academico")->with(['success'=>'Serviço Acadêmico editado com sucesso.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $academico = Academico::findOrFail($id);
      $tupla_localizacao = Localizacao::where("id", $academico->localizacao)->delete();
      $academico->destroy($id);

      return redirect()->route("Academico")->with(['success'=>'Serviço Acadêmico deletado com sucesso.']);
    }
}
