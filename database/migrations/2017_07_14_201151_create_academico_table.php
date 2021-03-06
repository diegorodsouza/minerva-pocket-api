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
          $table->string('observacao')->nullable();
          $table->string('funcionamento')->nullable();
          $table->string('contato')->nullable();
          $table->string('imagem')->nullable();
          $table->integer('status')->default(0);
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
