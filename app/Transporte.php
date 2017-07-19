<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Localizacao;

class Transporte extends Model
{
  protected $table = 'transporte';

  protected $fillable = [
    'linha','funcionamento','preco','imagem','tipo'
  ];
}
