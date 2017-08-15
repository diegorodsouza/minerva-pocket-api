<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \DB::table('users')->insert([
                 'name' => "DevMob UFRJ",
                 'email' => "devmobufrj@gmail.com",
                 'password' => "$2a$06$NPbu.pmB0Uii6tf91SzNp.PPMDS.q7EIISzXuYc19CuE7JwcuD6Yi",
                 'tipo' => 1,
             ]);
    }
}
