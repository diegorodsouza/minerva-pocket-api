<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Infraestrutura;
use App\Localizacao;
use App\CentroPonto;
use DB;

class InfraestruturaController extends Controller
{
  public function __construct()
  {
    if (\Route::currentRouteName() == 'Infraestrutura_API'){

    } else {
      $this->middleware('auth');
    }
  }

  public function returnAPI(){

    header("Access-Control-Allow-Origin: *");

    $data = array();
    $dataBanheiro = array();
    $dataBebedouro = array();
    $dataEstacionamento = array();
    $dataBicicletario = array();

// Banheiros
    $banheiro = Infraestrutura::where('tipo','Banheiro')->orderBy('nome', 'asc')->get();

      foreach ($banheiro as $infra) {
        $localizacao = Localizacao::findOrFail($infra->localizacao);
        $centro = CentroPonto::findOrFail($localizacao->centro_ponto_id);
        $infra->situacao = Infraestrutura::getSituacao($infra->situacao);

        $infra->localizacao = array([
          'latitude'  => $localizacao->latitude,
          'longitude' => $localizacao->longitude,
          'centro'    => $centro->descricao
          ]);

        array_push($dataBanheiro, $infra);
      }
      array_push($data, $dataBanheiro);

// Bebedouros
    $bebedouro = Infraestrutura::where('tipo','Bebedouro')->orderBy('nome', 'asc')->get();

      foreach ($bebedouro as $infra) {
        $localizacao = Localizacao::findOrFail($infra->localizacao);
        $centro = CentroPonto::findOrFail($localizacao->centro_ponto_id);
        $infra->situacao = Infraestrutura::getSituacao($infra->situacao);

        $infra->localizacao = array([
          'latitude'  => $localizacao->latitude,
          'longitude' => $localizacao->longitude,
          'centro'    => $centro->descricao
          ]);

        array_push($dataBebedouro, $infra);
      }
      array_push($data, $dataBebedouro);


// Estacionamento
    $estacionamento = Infraestrutura::where('tipo','Estacionamento')->orderBy('nome', 'asc')->get();

      foreach ($estacionamento as $infra) {
        $localizacao = Localizacao::findOrFail($infra->localizacao);
        $centro = CentroPonto::findOrFail($localizacao->centro_ponto_id);
        $infra->situacao = Infraestrutura::getSituacao($infra->situacao);

        $infra->localizacao = array([
          'latitude'  => $localizacao->latitude,
          'longitude' => $localizacao->longitude,
          'centro'    => $centro->descricao
          ]);

        array_push($dataEstacionamento, $infra);
      }
      array_push($data, $dataEstacionamento);

// Bicicletario
    $bicicletario = Infraestrutura::where('tipo','Bicicletario')->orderBy('nome', 'asc')->get();

      foreach ($bicicletario as $infra) {
        $localizacao = Localizacao::findOrFail($infra->localizacao);
        $centro = CentroPonto::findOrFail($localizacao->centro_ponto_id);
        $infra->situacao = Infraestrutura::getSituacao($infra->situacao);

        $infra->localizacao = array([
          'latitude'  => $localizacao->latitude,
          'longitude' => $localizacao->longitude,
          'centro'    => $centro->descricao
          ]);

        array_push($dataBicicletario, $infra);
      }
      array_push($data, $dataBicicletario);

    return $data;
  }

  public function index()
  {
    $infras = Infraestrutura::orderBy('nome', 'asc')->get();
    return view ("auth.infraestrutura.index", compact('infras'));
  }


  public function create()
  {
      $centros = DB::table('centro_ponto')->where('tipo', 'Centro')->get();
      return view ("auth.infraestrutura.create",compact('centros'));
  }


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

      $dadosInf = array(
        'nome'          => $dados['nome'],
        'tipo'          => $dados['tipo'],
        'detalhes'      => $dados['detalhes'],
        'localizacao'   => $local_id,
        'situacao'      => intval($dados['situacao'])
      );
      Infraestrutura::create($dadosInf);

      return redirect()->route('Infraestrutura')->with(['success'=>'Infraestrutura adicionada com sucesso.']);
  }


  public function edit($id)
  {
        $infra = Infraestrutura::findOrFail($id);
        $localizacao = Localizacao::findOrFail($infra->localizacao);
        $centros = DB::table('centro_ponto')->where('tipo', 'Centro')->get();
        return view ("auth.infraestrutura.edit", compact(['infra','localizacao','centros']));

  }


  public function update(Request $request, $id)
  {
    $dados = $request->all();

    $infra = Infraestrutura::findOrFail($id);

    // LOCALIZAÇÃO

    $dadosLoc = array(
      'latitude'        => $dados['latitude'],
      'longitude'       => $dados['longitude'],
      'centro_ponto_id' => intval($dados['centro'])
    );

    $local = Localizacao::findOrFail($infra->localizacao);

    $local->update($dadosLoc);

    // ACADEMICO

    $dadosInf = array(
      'nome'          => $dados['nome'],
      'tipo'          => $dados['tipo'],
      'detalhes'      => $dados['detalhes'],
      'localizacao'   => $local->id,
      'situacao'      => intval($dados['situacao'])
    );

    $infra->update($dadosInf);

    return redirect()->route("Infraestrutura")->with(['success'=>'Infraestrutura editada com sucesso.']);
  }


  public function destroy($id)
  {
    $infra = Infraestrutura::findOrFail($id);
    $tupla_localizacao = Localizacao::where("id", $infra->localizacao)->delete();
    $infra->destroy($id);

    return redirect()->route("Infraestrutura")->with(['success'=>'Infraestrutura deletada com sucesso.']);
  }
}
