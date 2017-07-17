<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicoBancoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('servico_banco', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('servico_id');
          $table->enum('bandeira',['Banco do Brasil','Bradesco','Itaú','24 Horas', 'Santander', 'Caixa']);
          $table->enum('tipo',['Agência','Caixa Eletrônico']);
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
      Schema::dropIfExists('servico_banco');
      DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
