<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    protected $table = 'servico';

    protected $fillable = [
      'localizacao', 'nome', 'funcionamento', 'imagem'
    ];
}
