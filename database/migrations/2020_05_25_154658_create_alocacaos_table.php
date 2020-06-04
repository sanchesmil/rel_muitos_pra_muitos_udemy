<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlocacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Criaçao da tabela de ligação 'ALOCACOES' entre DESENVOLVEDOR (N) X (N) PROJETO
        Schema::create('alocacoes', function (Blueprint $table) {
            $table->unsignedBigInteger('desenvolvedor_id');
            $table->foreign('desenvolvedor_id')->references('id')->on('desenvolvedores');  // Define a FK de 'desenvolvedores'

            $table->unsignedBigInteger('projeto_id');
            $table->foreign('projeto_id')->references('id')->on('projetos'); // Define a FK de 'projetos'

            $table->integer('horas_semanais');
           
            $table->timestamps();

            $table->primary(['desenvolvedor_id', 'projeto_id']);  // Define a PK composta ('desenvolvedor_id' + 'projeto_id')
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alocacoes');
    }
}
