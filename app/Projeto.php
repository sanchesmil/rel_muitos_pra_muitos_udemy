<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    function desenvolvedores(){

        //belongsToMany = 1º Parm: Modelo que vou retornar, 2º Parm: tabela de vínculo/ligação
        //withPivot = retorna o(s) campo(s) da tabela de ligação que eu desejo pegar
        return $this->belongsToMany('App\Desenvolvedor','alocacoes')->withPivot('horas_semanais');  
    }
}
