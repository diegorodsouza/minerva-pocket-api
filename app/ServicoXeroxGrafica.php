<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Localizacao;
use App\Servico;

class XeroxGrafica extends Model
{
    protected $table = 'servico_xerox_grafica';

    protected $fillable = [
      'servico_id', 'observacao', 'servico'
    ];

    public static function getXeroxGraficaNome($xerox_grafica_id){
      $xerox_grafica = ServicoXeroxGrafica::findOrFail($xerox_grafica_id);
      $servico = Servico::findOrFail($xerox_grafica->servico_id);
      return $servico->nome;
    }

    public static function getXeroxGraficaLocalizacao($xerox_grafica_id){
      $xerox_grafica = ServicoXeroxGrafica::findOrFail($xerox_grafica_id);
      $servico = Servico::findOrFail($xerox_grafica->servico_id);
      $local = Localizacao::findOrFail($servico->localizacao);
      $centro = Localizacao::getCentro($local->id);
      return $centro;
    }
}
