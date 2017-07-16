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
        Schema::dropIfExists('alimentacao_tipo_pagamento');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
