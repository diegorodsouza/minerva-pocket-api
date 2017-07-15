<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoDePagamento extends Model
{
    protected $table = 'tipo_de_pagamento';

    protected $fillable = [
      'descricao'
    ];
}
