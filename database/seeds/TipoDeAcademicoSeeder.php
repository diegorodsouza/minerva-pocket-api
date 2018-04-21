<?php

use Illuminate\Database\Seeder;

class TipoDeAcademicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \DB::table('tipo_de_academico')->insert(
              [
                'id' => 1,
                'descricao' => "Auditório",
              ]);
      \DB::table('tipo_de_academico')->insert(    
              [
                'id' => 2,
                'descricao' => "Biblioteca / Sala de Estudo",
              ]);
      \DB::table('tipo_de_academico')->insert(  
              [
                'id' => 3,
                'descricao' => "Centro/Diretório Acadêmico",
              ]);
      \DB::table('tipo_de_academico')->insert(  
              [
                'id' => 4,
                'descricao' => "Secretaria",
              ]);
      \DB::table('tipo_de_academico')->insert(  
              [
                'id' => 5,
                'descricao' => "Museu",
              ]);
    }
}
