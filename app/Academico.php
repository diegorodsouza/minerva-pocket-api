<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Localizacao;
use App\TipoDeAcademico;

class Academico extends Model
{
  protected $table = 'academico';

  protected $fillable = [
    'nome','funcionamento','tipo','imagem','localizacao','observacao','contato'
  ];

  public static function getLocalizacao($id){
    $academico = Academico::findOrFail($id);
    $local = Localizacao::findOrFail($academico->localizacao);
    $centro = Localizacao::getCentro($local->id);
    return $centro;
  }

  public static function getTipo($id){
    $academico = Academico::findOrFail($id);
    $tipo = TipoDeAcademico::findOrFail($academico->tipo);
    return $tipo->descricao;
  }
}
