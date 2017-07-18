<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CentroPonto;


class Localizacao extends Model
{
  protected $table = 'localizacao';

  protected $fillable = [
    'centro_ponto_id','latitude','longitude'
  ];

  public static function getCentro($id){
    $local = Localizacao::findOrFail($id);
    $centro = Centro::findOrFail($local->centro_ponto_id);
    return $centro->descricao;
  }
}
