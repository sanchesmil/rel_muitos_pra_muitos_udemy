<?php

use Illuminate\Database\Seeder;

class DesenvolvedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Deleta todos registros da tabela DESENVOLVEDORES antes de popular
        DB::table('desenvolvedores')->delete();  

        DB::table('desenvolvedores')->insert(['nome' => 'Pedro Silva','cargo' => 'Analista Pleno']);
        DB::table('desenvolvedores')->insert(['nome' => 'Raquel Melo','cargo' => 'Analista Senior']);
        DB::table('desenvolvedores')->insert(['nome' => 'João Goulart','cargo' => 'Programador Júnior']);

    }
}
