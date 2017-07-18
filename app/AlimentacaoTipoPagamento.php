<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlimentacaoTipoPagamento extends Model
{
  protected $table = 'alimentacao_tipo_pagamento';

  protected $fillable = [
    'alimentacao_id','tipo_pagamento_id',
  ];
}
