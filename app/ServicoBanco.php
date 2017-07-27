<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServicoBanco extends Model
{
    protected $table = 'servico_banco';

    protected $fillable = [
      'servico_id', 'bandeira', 'tipo'
    ];
}
