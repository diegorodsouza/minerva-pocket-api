<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Localizacao;

class CentroPonto extends Model
{
    protected $table = 'centro_ponto';

    protected $fillable = [
      'descricao','loc_id'
    ];

    public static function getLatitude($centro_id){
      $centroeponto = CentroPonto::findOrFail($centro_id);
      $localizacao = Localizacao::findOrFail($centroeponto->loc_id);
      return $localizacao->latitude;
    }

    public static function getLongitude($centro_id){
      $centroeponto = CentroPonto::findOrFail($centro_id);
      $localizacao = Localizacao::findOrFail($centroeponto->loc_id);
      return $localizacao->longitude;
    }
}
