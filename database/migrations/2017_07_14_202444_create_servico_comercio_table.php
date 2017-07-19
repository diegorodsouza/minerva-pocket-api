<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicoComercioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('servico_comercio', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('servico_id');
          $table->string('especialidade')->nullable();
          $table->string('descricao')->nullable();
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
      Schema::dropIfExists('servico_comercio');
      DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
