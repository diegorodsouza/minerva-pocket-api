<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterServicoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('servico', function (Blueprint $table) {
        $table->foreign('localizacao')
              ->references('id')->on('localizacao')
              ->onDelete('cascade')
              ->onUpdate('cascade');
      });

      Schema::table('servico_banco', function (Blueprint $table) {
        $table->foreign('servico_id')
              ->references('id')->on('servico')
              ->onDelete('cascade')
              ->onUpdate('cascade');
      });

      Schema::table('servico_comercio', function (Blueprint $table) {
        $table->foreign('servico_id')
              ->references('id')->on('servico')
              ->onDelete('cascade')
              ->onUpdate('cascade');
      });

      Schema::table('servico_xerox_grafica', function (Blueprint $table) {
        $table->foreign('servico_id')
              ->references('id')->on('servico')
              ->onDelete('cascade')
              ->onUpdate('cascade');
      });

      Schema::table('servico_outros', function (Blueprint $table) {
        $table->foreign('servico_id')
              ->references('id')->on('servico')
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
