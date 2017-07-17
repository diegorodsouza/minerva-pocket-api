<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CentroPonto extends Model
{
    protected $table = 'centro_ponto';

    protected $fillable = [
      'descricao'
    ];
}
