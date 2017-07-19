<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransporteLocalizacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('transporte_localizacao', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('transporte_id');
          $table->integer('localizacao_id');
          $table->timestamps();

      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      DB::statement('SET FOREIGN_KEY_CHECKS=0');
      Schema::dropIfExists('transporte_localizacao');
      DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
