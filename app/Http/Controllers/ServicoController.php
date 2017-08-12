<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Servico;
use App\ServicoBanco;
use App\ServicoComercio;
use App\ServicoOutro;
use App\ServicoXeroxGrafica;
use App\Localizacao;
use App\CentroPonto;
use App\ImgurLink;
use DB;

class ServicoController extends Controller
{

    public function __construct()
    {
      if (\Route::currentRouteName() == 'Servico_API'){

      } else {
         $this->middleware('auth');
      }
    }

    public function returnAPI(){

      header("Access-Control-Allow-Origin: *");

      $dataGeral = array();
      $dataBancos = array();
      $dataComercios = array();
      $dataOutros = array();
      $dataXeroxGraficas = array();

      $bancos = ServicoBanco::orderBy('id', 'asc')->get();
      $comercios = ServicoComercio::orderBy('id', 'asc')->get();
      $outros = ServicoOutro::orderBy('id', 'asc')->get();
      $xerox_graficas = ServicoXeroxGrafica::orderBy('id', 'asc')->get();
      $servicos = Servico::orderBy('id', 'asc')->get();

        foreach ($bancos as $banco) {
          $servico = Servico::findOrFail($banco->servico_id);
          $localizacao = Localizacao::findOrFail($servico->localizacao);
          $centro = CentroPonto::findOrFail($localizacao->centro_ponto_id);

          $servico->localizacao = array([
            'latitude'  => $localizacao->latitude,
            'longitude' => $localizacao->longitude,
            'centro'    => $centro->descricao
            ]);

          $servico->imagem = ImgurLink::transformImgurLink($servico->imagem);
          $tudoBanco = array([
            'id'            => $servico->id,
            'nome'          => $servico->nome,
            'localizacao'   => $servico->localizacao,
            'funcionamento' => $servico->funcionamento,
            'imagem'        => $servico->imagem,
            'bandeira'      => $banco->bandeira,
            'tipo'          => $banco->tipo
            ]);

          array_push($dataBancos, $tudoBanco);
        }

        foreach ($comercios as $comercio) {
          $servico = Servico::findOrFail($comercio->servico_id);
          $localizacao = Localizacao::findOrFail($servico->localizacao);
          $centro = CentroPonto::findOrFail($localizacao->centro_ponto_id);

          $servico->localizacao = array([
            'latitude'  => $localizacao->latitude,
            'longitude' => $localizacao->longitude,
            'centro'    => $centro->descricao
            ]);

          $servico->imagem = ImgurLink::transformImgurLink($servico->imagem);
          $tudoComercio = array([
            'id'            => $servico->id,
            'nome'          => $servico->nome,
            'localizacao'   => $servico->localizacao,
            'funcionamento' => $servico->funcionamento,
            'imagem'        => $servico->imagem,
            'especialidade' => $comercio->especialidade,
            'descricao'     => $comercio->descricao
            ]);

          array_push($dataComercios, $tudoComercio);
        }

        foreach ($outros as $outro) {
          $servico = Servico::findOrFail($outro->servico_id);
          $localizacao = Localizacao::findOrFail($servico->localizacao);
          $centro = CentroPonto::findOrFail($localizacao->centro_ponto_id);

          $servico->localizacao = array([
            'latitude'  => $localizacao->latitude,
            'longitude' => $localizacao->longitude,
            'centro'    => $centro->descricao
            ]);

          $servico->imagem = ImgurLink::transformImgurLink($servico->imagem);
          $tudoOutro = array([
            'id'            => $servico->id,
            'nome'          => $servico->nome,
            'localizacao'   => $servico->localizacao,
            'funcionamento' => $servico->funcionamento,
            'imagem'        => $servico->imagem,
            'servico'       => $outro->servico,
            'observacao'    => $outro->observacao
            ]);

          array_push($dataOutros, $tudoOutro);
        }

        foreach ($xerox_graficas as $xerox_grafica) {
          $servico = Servico::findOrFail($xerox_grafica->servico_id);
          $localizacao = Localizacao::findOrFail($servico->localizacao);
          $centro = CentroPonto::findOrFail($localizacao->centro_ponto_id);

          $servico->localizacao = array([
            'latitude'  => $localizacao->latitude,
            'longitude' => $localizacao->longitude,
            'centro'    => $centro->descricao
            ]);

          $servico->imagem = ImgurLink::transformImgurLink($servico->imagem);
          $tudoXeroxGrafica = array([
            'id'            => $servico->id,
            'nome'          => $servico->nome,
            'localizacao'   => $servico->localizacao,
            'funcionamento' => $servico->funcionamento,
            'imagem'        => $servico->imagem,
            'servico'       => $xerox_grafica->servico,
            'observacao'    => $xerox_grafica->observacao
            ]);

          array_push($dataXeroxGraficas, $tudoXeroxGrafica);
        }


      array_push($dataGeral, $dataBancos);
      array_push($dataGeral, $dataComercios);
      array_push($dataGeral, $dataOutros);
      array_push($dataGeral, $dataXeroxGraficas);

      return $dataGeral;
    }

    public function indexBanco()
    {
      $bancos = ServicoBanco::orderBy('id', 'asc')->get();
      $servicos = Servico::orderBy('id', 'asc')->get();
      return view ("auth.servico.banco.index", compact(['bancos','servicos']));

    }

    public function indexComercio()
    {
      $comercios = ServicoComercio::orderBy('id', 'asc')->get();
      $servicos = Servico::orderBy('id', 'asc')->get();
      return view ("auth.servico.comercio.index", compact(['comercios','servicos']));

    }

    public function indexOutro()
    {
      $outros = ServicoOutro::orderBy('id', 'asc')->get();
      $servicos = Servico::orderBy('id', 'asc')->get();
      return view ("auth.servico.outro.index", compact(['outros','servicos']));

    }

    public function indexXeroxGrafica()
    {
      $xerox_graficas = ServicoXeroxGrafica::orderBy('id', 'asc')->get();
      $servicos = Servico::orderBy('id', 'asc')->get();
      return view ("auth.servico.xerox_grafica.index", compact(['xerox_graficas','servicos']));

    }


    public function createBanco()
    {
        $centros = DB::table('centro_ponto')->where('tipo', 'Centro')->get();
        return view ("auth.servico.banco.create",compact(['centros']));
    }

    public function createComercio()
    {
        $centros = DB::table('centro_ponto')->where('tipo', 'Centro')->get();
        return view ("auth.servico.comercio.create",compact(['centros']));
    }

    public function createOutro()
    {
        $centros = DB::table('centro_ponto')->where('tipo', 'Centro')->get();
        return view ("auth.servico.outro.create",compact(['centros']));
    }

    public function createXeroxGrafica()
    {
        $centros = DB::table('centro_ponto')->where('tipo', 'Centro')->get();
        return view ("auth.servico.xerox_grafica.create",compact(['centros']));
    }


    public function storeBanco(Request $request)
    {
        $dados = $request->all();

        // LOCALIZAÇÃO

        $dadosLoc = array(
          'latitude'        => $dados['latitude'],
          'longitude'       => $dados['longitude'],
          'centro_ponto_id' => intval($dados['centro'])
        );
        $local_id = Localizacao::insertGetId($dadosLoc);

        // SERVIÇO

        $dadosServ = array(
          'localizacao'   => $local_id,
          'funcionamento' => $dados['funcionamento'],
          'nome'          => $dados['nome'],
          'imagem'        => $dados['imagem'],
        );

        $serv_id = Servico::insertGetId($dadosServ);

        // SERVIÇO BANCÁRIO

        $dadosBanc = array(
          'servico_id'         => $serv_id,
          'bandeira'           => $dados['bandeira'],
          'tipo'               => $dados['tipo'],
        );

        ServicoBanco::create($dadosBanc);

        return redirect()->route('ServicoBanco')->with(['success'=>'Serviço Bancário adicionado com sucesso.']);
    }

    public function storeComercio(Request $request)
    {
        $dados = $request->all();

        // LOCALIZAÇÃO

        $dadosLoc = array(
          'latitude'        => $dados['latitude'],
          'longitude'       => $dados['longitude'],
          'centro_ponto_id' => intval($dados['centro'])
        );
        $local_id = Localizacao::insertGetId($dadosLoc);

        // SERVIÇO

        $dadosServ = array(
          'localizacao'   => $local_id,
          'funcionamento' => $dados['funcionamento'],
          'nome'          => $dados['nome'],
          'imagem'        => $dados['imagem'],
        );

        $serv_id = Servico::insertGetId($dadosServ);

        // SERVIÇO BANCÁRIO

        $dadosCom = array(
          'servico_id'         => $serv_id,
          'especialidade'      => $dados['especialidade'],
          'descricao'          => $dados['descricao'],
        );

        ServicoComercio::create($dadosCom);

        return redirect()->route('ServicoComercio')->with(['success'=>'Serviço de Comércio adicionado com sucesso.']);
    }

    public function storeOutro(Request $request)
    {
        $dados = $request->all();

        // LOCALIZAÇÃO

        $dadosLoc = array(
          'latitude'        => $dados['latitude'],
          'longitude'       => $dados['longitude'],
          'centro_ponto_id' => intval($dados['centro'])
        );
        $local_id = Localizacao::insertGetId($dadosLoc);

        // SERVIÇO

        $dadosServ = array(
          'localizacao'   => $local_id,
          'funcionamento' => $dados['funcionamento'],
          'nome'          => $dados['nome'],
          'imagem'        => $dados['imagem'],
        );

        $serv_id = Servico::insertGetId($dadosServ);

        // SERVIÇO BANCÁRIO

        $dadosOut = array(
          'servico_id'         => $serv_id,
          'servico'            => $dados['servico'],
          'observacao'         => $dados['observacao'],
        );

        ServicoOutro::create($dadosOut);

        return redirect()->route('ServicoOutro')->with(['success'=>'Serviço Diverso adicionado com sucesso.']);
    }

    public function storeXeroxGrafica(Request $request)
    {
        $dados = $request->all();

        // LOCALIZAÇÃO

        $dadosLoc = array(
          'latitude'        => $dados['latitude'],
          'longitude'       => $dados['longitude'],
          'centro_ponto_id' => intval($dados['centro'])
        );
        $local_id = Localizacao::insertGetId($dadosLoc);

        // SERVIÇO

        $dadosServ = array(
          'localizacao'   => $local_id,
          'funcionamento' => $dados['funcionamento'],
          'nome'          => $dados['nome'],
          'imagem'        => $dados['imagem'],
        );

        $serv_id = Servico::insertGetId($dadosServ);

        // SERVIÇO BANCÁRIO

        $dadosXer = array(
          'servico_id'         => $serv_id,
          'servico'            => $dados['servico'],
          'observacao'         => $dados['observacao'],
        );

        ServicoXeroxGrafica::create($dadosXer);

        return redirect()->route('ServicoXeroxGrafica')->with(['success'=>'Serviço de Xerox ou Gráfica adicionado com sucesso.']);
    }


    public function editBanco($id)
    {
          $banco = ServicoBanco::findOrFail($id);
          $servico = Servico::findOrFail($banco->servico_id);
          $localizacao = Localizacao::findOrFail($servico->localizacao);
          $centros = DB::table('centro_ponto')->where('tipo', 'Centro')->get();
          return view ("auth.servico.banco.edit", compact(['banco','servico',
                                                           'localizacao','centros']));

    }

    public function editComercio($id)
    {
          $comercio = ServicoComercio::findOrFail($id);
          $servico = Servico::findOrFail($comercio->servico_id);
          $localizacao = Localizacao::findOrFail($servico->localizacao);
          $centros = DB::table('centro_ponto')->where('tipo', 'Centro')->get();
          return view ("auth.servico.comercio.edit", compact(['comercio','servico',
                                                              'localizacao','centros']));

    }

    public function editOutro($id)
    {
          $outro = ServicoOutro::findOrFail($id);
          $servico = Servico::findOrFail($outro->servico_id);
          $localizacao = Localizacao::findOrFail($servico->localizacao);
          $centros = DB::table('centro_ponto')->where('tipo', 'Centro')->get();
          return view ("auth.servico.outro.edit", compact(['outro','servico',
                                                           'localizacao','centros']));

    }

    public function editXeroxGrafica($id)
    {
          $xerox_grafica = ServicoXeroxGrafica::findOrFail($id);
          $servico = Servico::findOrFail($xerox_grafica->servico_id);
          $localizacao = Localizacao::findOrFail($servico->localizacao);
          $centros = DB::table('centro_ponto')->where('tipo', 'Centro')->get();
          return view ("auth.servico.xerox_grafica.edit", compact(['xerox_grafica','servico',
                                                                   'localizacao','centros']));

    }


    public function updateBanco(Request $request, $id)
    {
      $dados = $request->all();

      $banco = ServicoBanco::findOrFail($id);

      $servico = Servico::findOrFail($banco->servico_id);

      $local = Localizacao::findOrFail($servico->localizacao);

      // LOCALIZAÇÃO

      $dadosLoc = array(
        'latitude'        => $dados['latitude'],
        'longitude'       => $dados['longitude'],
        'centro_ponto_id' => intval($dados['centro'])
      );

      $local->update($dadosLoc);

      // SERVIÇO

      $dadosServ = array(
        'localizacao'   => $local->id,
        'funcionamento' => $dados['funcionamento'],
        'nome'          => $dados['nome'],
        'imagem'        => $dados['imagem'],
      );

      $servico->update($dadosServ);

      // SERVIÇO BANCÁRIO

      $dadosBanc = array(
        'servico_id'         => $servico->id,
        'bandeira'           => $dados['bandeira'],
        'tipo'               => $dados['tipo'],
      );

      $banco->update($dadosBanc);


      return redirect()->route("ServicoBanco")->with(['success'=>'Serviço Bancário editado com sucesso.']);
    }

    public function updateComercio(Request $request, $id)
    {
      $dados = $request->all();

      $comercio = ServicoComercio::findOrFail($id);

      $servico = Servico::findOrFail($comercio->servico_id);

      $local = Localizacao::findOrFail($servico->localizacao);

      // LOCALIZAÇÃO

      $dadosLoc = array(
        'latitude'        => $dados['latitude'],
        'longitude'       => $dados['longitude'],
        'centro_ponto_id' => intval($dados['centro'])
      );

      $local->update($dadosLoc);

      // SERVIÇO

      $dadosServ = array(
        'localizacao'   => $local->id,
        'funcionamento' => $dados['funcionamento'],
        'nome'          => $dados['nome'],
        'imagem'        => $dados['imagem'],
      );

      $servico->update($dadosServ);

      // SERVIÇO DE COMÉRCIO

      $dadosCom = array(
        'servico_id'         => $servico->id,
        'especialidade'      => $dados['especialidade'],
        'descricao'          => $dados['descricao'],
      );

      $comercio->update($dadosCom);


      return redirect()->route("ServicoComercio")->with(['success'=>'Serviço de Comércio editado com sucesso.']);
    }

    public function updateOutro(Request $request, $id)
    {
      $dados = $request->all();

      $outro = ServicoOutro::findOrFail($id);

      $servico = Servico::findOrFail($outro->servico_id);

      $local = Localizacao::findOrFail($servico->localizacao);

      // LOCALIZAÇÃO

      $dadosLoc = array(
        'latitude'        => $dados['latitude'],
        'longitude'       => $dados['longitude'],
        'centro_ponto_id' => intval($dados['centro'])
      );

      $local->update($dadosLoc);

      // SERVIÇO

      $dadosServ = array(
        'localizacao'   => $local->id,
        'funcionamento' => $dados['funcionamento'],
        'nome'          => $dados['nome'],
        'imagem'        => $dados['imagem'],
      );

      $servico->update($dadosServ);

      // SERVIÇO DIVERSO

      $dadosOut = array(
        'servico_id'         => $servico->id,
        'servico'            => $dados['servico'],
        'observacao'         => $dados['observacao'],
      );

      $outro->update($dadosOut);


      return redirect()->route("ServicoOutro")->with(['success'=>'Serviço Diverso editado com sucesso.']);
    }

    public function updateXeroxGrafica(Request $request, $id)
    {
      $dados = $request->all();

      $xerox_grafica = ServicoXeroxGrafica::findOrFail($id);

      $servico = Servico::findOrFail($xerox_grafica->servico_id);

      $local = Localizacao::findOrFail($servico->localizacao);

      // LOCALIZAÇÃO

      $dadosLoc = array(
        'latitude'        => $dados['latitude'],
        'longitude'       => $dados['longitude'],
        'centro_ponto_id' => intval($dados['centro'])
      );

      $local->update($dadosLoc);

      // SERVIÇO

      $dadosServ = array(
        'localizacao'   => $local->id,
        'funcionamento' => $dados['funcionamento'],
        'nome'          => $dados['nome'],
        'imagem'        => $dados['imagem'],
      );

      $servico->update($dadosServ);

      // SERVIÇO DIVERSO

      $dadosXer = array(
        'servico_id'         => $servico->id,
        'servico'            => $dados['servico'],
        'observacao'         => $dados['observacao'],
      );

      $xerox_grafica->update($dadosXer);


      return redirect()->route("ServicoXeroxGrafica")->with(['success'=>'Serviço de Xerox ou Gráfica editado com sucesso.']);
    }


    public function destroyBanco($id)
    {
      $banco = ServicoBanco::findOrFail($id);
      $servico = Servico::findOrFail($banco->servico_id);
      $tupla_localizacao = Localizacao::where("id", $servico->localizacao)->delete();
      $servico->destroy($banco->servico_id);
      $banco->destroy($id);

      return redirect()->route("ServicoBanco")->with(['success'=>'Serviço Bancário deletado com sucesso.']);
    }

    public function destroyComercio($id)
    {
      $comercio = ServicoComercio::findOrFail($id);
      $servico = Servico::findOrFail($comercio->servico_id);
      $tupla_localizacao = Localizacao::where("id", $servico->localizacao)->delete();
      $servico->destroy($comercio->servico_id);
      $comercio->destroy($id);

      return redirect()->route("ServicoComercio")->with(['success'=>'Serviço de Comércio deletado com sucesso.']);
    }

    public function destroyOutro($id)
    {
      $outro = ServicoOutro::findOrFail($id);
      $servico = Servico::findOrFail($outro->servico_id);
      $tupla_localizacao = Localizacao::where("id", $servico->localizacao)->delete();
      $servico->destroy($outro->servico_id);
      $outro->destroy($id);

      return redirect()->route("ServicoOutro")->with(['success'=>'Serviço Diverso deletado com sucesso.']);
    }

    public function destroyXeroxGrafica($id)
    {
      $xerox_grafica = ServicoXeroxGrafica::findOrFail($id);
      $servico = Servico::findOrFail($xerox_grafica->servico_id);
      $tupla_localizacao = Localizacao::where("id", $servico->localizacao)->delete();
      $servico->destroy($xerox_grafica->servico_id);
      $xerox_grafica->destroy($id);

      return redirect()->route("ServicoXeroxGrafica")->with(['success'=>'Serviço de Xerox ou Gráfica deletado com sucesso.']);
    }
}
