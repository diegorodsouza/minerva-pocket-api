<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Localizacao;

class Infraestrutura extends Model
{
  protected $table = 'infraestrutura';

  protected $fillable = [
    'nome','detalhes','tipo','situacao','localizacao',
  ];

  public static function getLocalizacao($id){
    $infra = Infraestrutura::findOrFail($id);
    $local = Localizacao::findOrFail($infra->localizacao);
    $centro = Localizacao::getCentro($local->id);
    return $centro;
  }

  public static function getSituacao($situacao){
    if ($situacao == 1)
      return "Inutilizável"
    if ($situacao == 2)
      return "Utilizável"
    if ($situacao == 3)
      return "Ótimo"
    return null;
  }
}
