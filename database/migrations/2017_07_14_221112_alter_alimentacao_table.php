<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAlimentacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('alimentacao', function (Blueprint $table) {
          $table->foreign('localizacao')
                ->references('id')->on('localizacao')
                ->onDelete('cascade')
                ->onUpdate('cascade');
      });

      Schema::table('alimentacao_tipo_comida', function (Blueprint $table) {
          $table->foreign('alimentacao_id')
                ->references('id')->on('alimentacao')
                ->onDelete('cascade')
                ->onUpdate('cascade');
          $table->foreign('tipo_comida_id')
                ->references('id')->on('tipo_de_comida')
                ->onDelete('cascade')
                ->onUpdate('cascade');
      });

      Schema::table('alimentacao_tipo_pagamento', function (Blueprint $table) {
          $table->foreign('alimentacao_id')
                ->references('id')->on('alimentacao')
                ->onDelete('cascade')
                ->onUpdate('cascade');
          $table->foreign('tipo_pagamento_id')
                ->references('id')->on('tipo_de_pagamento')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
