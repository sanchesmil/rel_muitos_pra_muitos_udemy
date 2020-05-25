<?php

use Illuminate\Database\Seeder;

class AlocacoesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Deleta todos registros da tabela ALOCACOES antes de popular
        DB::table('alocacoes')->delete();  

        DB::table('alocacoes')->insert([
            'desenvolvedor_id' => 1, // Desenv. Pedro
            'projeto_id' => 2, //Sist. Bibliotecas
            'horas_semanais' => 20,
        ]);

        DB::table('alocacoes')->insert([
            'desenvolvedor_id' => 2, // Desenv. Raquel
            'projeto_id' => 2, //Sist. Bibliotecas
            'horas_semanais' => 10,
        ]);

        DB::table('alocacoes')->insert([
            'desenvolvedor_id' => 3, // Desenv. João
            'projeto_id' => 1, //Sist. Alocação de Recursos
            'horas_semanais' => 30,
        ]);

        DB::table('alocacoes')->insert([
            'desenvolvedor_id' => 2, // Desenv. Raquel
            'projeto_id' => 3, //Sist. Vendas
            'horas_semanais' => 10,
        ]);

        DB::table('alocacoes')->insert([
            'desenvolvedor_id' => 1, // Desenv. Pedro
            'projeto_id' => 4, //Novo Sistema
            'horas_semanais' => 10,
        ]);

        DB::table('alocacoes')->insert([
            'desenvolvedor_id' => 2, // Desenv. Raquel
            'projeto_id' => 4, //Novo Sistema
            'horas_semanais' => 10,
        ]);
    }
}
