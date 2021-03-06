<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalizacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('localizacao', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('centro_ponto_id');
          $table->string('latitude');
          $table->string('longitude');
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
        Schema::dropIfExists('localizacao');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
