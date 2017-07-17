<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAcademicoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('academico', function (Blueprint $table) {
        $table->foreign('localizacao')
              ->references('id')->on('localizacao')
              ->onDelete('cascade')
              ->onUpdate('cascade');
        $table->foreign('tipo')
              ->references('id')->on('tipo_de_academico')
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
