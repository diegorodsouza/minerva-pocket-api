<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNivelDeAcessoUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('users', function (Blueprint $table) {
          $table->integer('nivel_de_acesso')->default(0);
      });

    DB::statement('UPDATE users SET nivel_de_acesso=1 WHERE `email` LIKE "devmobufrj@gmail.com"');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('users', function (Blueprint $table) {
        $table->dropColumn([
          'nivel_de_acesso',
        ]);
     });

    }
}
