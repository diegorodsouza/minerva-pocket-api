<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlimentacaoTipoComida extends Model
{
  protected $table = 'alimentacao_tipo_comida';

  protected $fillable = [
    'alimentacao_id','tipo_comida_id',
  ];
}
