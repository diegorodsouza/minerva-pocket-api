<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlimentacaoTipoComidaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('alimentacao_tipo_comida', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('alimentacao_id');
          $table->integer('tipo_comida_id');
          $table->timestamps();


          $table->foreign('alimentacao_id')
                ->references('id')->on('alimentacao')
                ->onDelete('cascade');
          $table->foreign('tipo_comida_id')
                ->references('id')->on('tipo_de_comida')
                ->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
            Schema::dropIfExists('alimentacao_tipo_comida');
    }
}
