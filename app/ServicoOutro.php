<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Localizacao;
use App\Servico;

class ServicoOutro extends Model
{
    protected $table = 'servico_outros';

    protected $fillable = [
      'servico_id', 'observacao', 'servico'
    ];

    public static function getOutroNome($outro_id){
      $outro = ServicoOutro::findOrFail($outro_id);
      $servico = Servico::findOrFail($outro->servico_id);
      return $servico->nome;
    }

    public static function getOutroLocalizacao($outro_id){
      $outro = ServicoOutro::findOrFail($outro_id);
      $servico = Servico::findOrFail($outro->servico_id);
      $local = Localizacao::findOrFail($servico->localizacao);
      $centro = Localizacao::getCentro($local->id);
      return $centro;
    }
}
