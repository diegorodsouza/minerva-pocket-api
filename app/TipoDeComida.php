<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoDeComida extends Model
{
    protected $table = 'tipo_de_comida';

    protected $fillable = [
      'descricao'
    ];
}
