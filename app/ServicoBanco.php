<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Localizacao;
use App\Servico;

class ServicoBanco extends Model
{
    protected $table = 'servico_banco';

    protected $fillable = [
      'servico_id', 'bandeira', 'tipo'
    ];

    public static function getBancoNome($banco_id){
      $banco = ServicoBanco::findOrFail($banco_id);
      $servico = Servico::findOrFail($banco->servico_id);
      return $servico->nome;
    }

    public static function getBancoLocalizacao($banco_id){
      $banco = ServicoBanco::findOrFail($banco_id);
      $servico = Servico::findOrFail($banco->servico_id);
      $local = Localizacao::findOrFail($servico->localizacao);
      $centro = Localizacao::getCentro($local->id);
      return $centro;
    }
}
