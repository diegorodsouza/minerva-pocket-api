<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServicoOutro extends Model
{
    protected $table = 'servico_outros';

    protected $fillable = [
      'servico_id', 'observacao', 'servico'
    ];
}
