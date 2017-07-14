<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlimentacaoTipoPagamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('alimentacao_tipo_pagamento', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('alimentacao_id');
          $table->integer('tipo_pagamento_id');
          $table->timestamps();


          $table->foreign('alimentacao_id')
                ->references('id')->on('alimentacao')
                ->onDelete('cascade');
          $table->foreign('tipo_pagamento_id')
                ->references('id')->on('tipo_de_pagamento')
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
        //
    }
}
