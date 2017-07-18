<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Localizacao;

class CentroPonto extends Model
{
    protected $table = 'centro_ponto';

    protected $fillable = [
      'descricao'
    ];

    public static function getLatitude($centro_id){
      $centroeponto = CentroPonto::findOrFail($centro_id);
      $localizacao = \DB::table('localizacao')->where('created_at', '>=', $centroeponto->created_at)->first();
      return $localizacao->latitude;

    public static function getLongitude($centro_id){
      $centroeponto = CentroPonto::findOrFail($centro_id);
      $localizacao = \DB::table('localizacao')->where('created_at', '>=', $centroeponto->created_at)->first();
      return $localizacao->longitude;
    }
}
