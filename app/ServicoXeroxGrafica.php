<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class XeroxGrafica extends Model
{
    protected $table = 'servico_xerox_grafica';

    protected $fillable = [
      'servico_id', 'observacao', 'servico'
    ];
}
