<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransporteLocalizacao extends Model
{
  protected $table = 'transporte_localizacao';

  protected $fillable = [
    'transporte_id','localizacao_id',
  ];
}
