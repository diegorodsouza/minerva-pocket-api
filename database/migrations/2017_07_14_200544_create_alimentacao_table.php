<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlimentacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('alimentacao', function (Blueprint $table) {
          $table->increments('id');
          $table->string('nome');
          $table->integer('tipo_de_comida');
          $table->integer('tipo_de_pagamento');
          $table->string('funcionamento');
          $table->string('preco');
          $table->integer('localizacao');
          $table->timestamps();


          $table->foreign('tipo_de_comida')
                ->references('id')->on('alimentacao_tipo_comida')
                ->onDelete('cascade');
          $table->foreign('tipo_de_pagamento')
                ->references('id')->on('alimentacao_tipo_pagamento')
                ->onDelete('cascade');
          $table->foreign('localizacao')
                ->references('id')->on('localizacao')
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
        Schema::dropIfExists('alimentacao');
    }
}
