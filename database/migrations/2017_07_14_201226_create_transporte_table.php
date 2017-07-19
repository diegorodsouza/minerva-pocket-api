<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransporteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('transporte', function (Blueprint $table) {
          $table->increments('id');
          $table->string('linha');
          $table->string('observacao')->nullable();
          $table->string('preco')->nullable();
          $table->enum('tipo',['Interno','Externo']);
          $table->string('funcionamento')->nullable();
          $table->string('imagem')->nullable();
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
      Schema::dropIfExists('transporte');
      DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
