<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicoOutrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('servico_outros', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('servico_id');
          $table->string('observacao')->nullable();
          $table->string('servico');
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
      Schema::dropIfExists('servico_outros');
      DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
