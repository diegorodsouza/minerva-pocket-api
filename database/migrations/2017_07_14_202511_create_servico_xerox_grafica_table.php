<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicoXeroxGraficaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('servico_xerox_grafica', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('servico_id');
          $table->string('observacao');
          $table->enum('servico',['Xerox','Gráfica']);
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
      Schema::dropIfExists('servico_xerox_grafica');
      DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
