<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCentroPontoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('centro_ponto', function (Blueprint $table) {
          $table->increments('id');
          $table->string('descricao');
          $table->integer('loc_id')->nullable();
          $table->enum('tipo',['Centro','Ponto']);
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
        Schema::dropIfExists('centro_ponto');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
