<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfraestruturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('infraestrutura', function (Blueprint $table) {
          $table->increments('id');
          $table->string('nome');
          $table->enum('tipo',['Banheiro','Estacionamento','Bebedouro']);
          $table->integer('localizacao');
          $table->string('detalhes')->nullable();
          $table->integer('situacao')->default(1);
          $table->integer('status')->default(0);
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
      Schema::dropIfExists('infraestrutura');
      DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
