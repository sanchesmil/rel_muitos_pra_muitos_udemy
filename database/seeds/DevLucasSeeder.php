<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DevLucasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /* Obs.: Executar essa seed individualmente: 
                 php artisan db:seed --class=DevLucasSeeder
         */

        DB::table('desenvolvedores')->insert([
            ['nome' => 'Lucas','cargo' => 'CEO']
        ]);
    }
}
