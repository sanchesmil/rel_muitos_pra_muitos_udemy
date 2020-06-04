<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Desenvolvedor extends Model
{
    protected $table = 'desenvolvedores'; // É necessário informar o nome da tabela ao Laravel qd não sigo o padrão 

    // relacionamento n x n
    public function projetos(){
        return $this->belongsToMany('App\Projeto','alocacoes')->withPivot('horas_semanais');
    }

    //belongsToMany = 1º Parm: Modelo que vou retornar, 2º Parm: tabela de vínculo/ligação
    //withPivot = retorna o(s) campo(s) da tabela de ligação que eu desejo pegar
}
