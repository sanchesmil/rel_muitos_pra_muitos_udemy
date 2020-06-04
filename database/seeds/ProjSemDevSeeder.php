<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjSemDevSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /* Obs.: Executar essa seed individualmente: 
                 php artisan db:seed --class=ProjSemDevSeeder
        */

        DB::table('projetos')->insert([
            'nome' => 'Sistema LUMIAR',
            'estimativa_horas' => 130,
        ]);
    }
}
