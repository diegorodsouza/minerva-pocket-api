<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Localizacao;
use App\Servico;

class ServicoComercio extends Model
{
  protected $table = 'servico_comercio';

  protected $fillable = [
    'servico_id', 'observacao', 'especialidade'
  ];

  public static function getComercioNome($comercio_id){
    $comercio = ServicoComercio::findOrFail($comercio_id);
    $servico = Servico::findOrFail($comercio->servico_id);
    return $servico->nome;
  }

  public static function getComercioLocalizacao($comercio_id){
    $comercio = ServicoComercio::findOrFail($comercio_id);
    $servico = Servico::findOrFail($comercio->servico_id);
    $local = Localizacao::findOrFail($servico->localizacao);
    $centro = Localizacao::getCentro($local->id);
    return $centro;
  }

}
