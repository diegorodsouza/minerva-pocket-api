<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcademicoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('academico', function (Blueprint $table) {
          $table->increments('id');
          $table->string('nome');
          $table->integer('tipo');
          $table->integer('localizacao');
          $table->string('observacao');
          $table->string('funcionamento');
          $table->string('telefone');
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
        Schema::dropIfExists('academico');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
