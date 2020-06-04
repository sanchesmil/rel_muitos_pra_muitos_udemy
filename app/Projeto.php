<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    function desenvolvedores(){
        return $this->belongsToMany('App\Desenvolvedor','alocacoes')->withPivot('horas_semanais');  
    }

     //belongsToMany = 1º Parm: Modelo que vou retornar, 2º Parm: tabela de ligação
     //withPivot = retorna o(s) campo(s) da tabela de ligação que eu desejo pegar
}