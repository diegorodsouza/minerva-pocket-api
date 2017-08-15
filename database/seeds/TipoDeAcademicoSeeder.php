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
              ],
              [
                'id' => 2,
                'descricao' => "Biblioteca",
              ],
              [
                'id' => 3,
                'descricao' => "Centro/Diretório Acadêmico",
              ],
              [
                'id' => 4,
                'descricao' => "Secretaria",
              ]
           );
    }
}
