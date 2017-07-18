<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Localizacao;

class Alimentacao extends Model
{
  protected $table = 'alimentacao';

  protected $fillable = [
    'nome','funcionamento','preco','imagem','localizacao'
  ];

  function getLocalizacao($id){
    $alimentacao = Alimentacao::findOrFail($id);
    $local = Localizacao::findOrFail($alimentacao->localizacao);
    $centro = Localizacao::getCentro($local->id);
    return $centro;

  }
}
