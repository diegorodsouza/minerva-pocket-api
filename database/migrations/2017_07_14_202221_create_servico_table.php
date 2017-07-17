<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('servico', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('localizacao');
          $table->string('nome');
          $table->string('funcionamento');
          $table->string('imagem');
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
      Schema::dropIfExists('servico');
      DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
