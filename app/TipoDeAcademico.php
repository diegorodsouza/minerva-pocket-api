<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoDeAcademico extends Model
{
    protected $table = 'tipo_de_academico';

    protected $fillable = [
      'descricao'
    ];
}
