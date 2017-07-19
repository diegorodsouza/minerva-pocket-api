<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTransporteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('transporte_localizacao', function (Blueprint $table) {
          $table->foreign('transporte_id')
                ->references('id')->on('transporte');
          $table->foreign('localizacao_id')
                ->references('id')->on('localizacao');
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
