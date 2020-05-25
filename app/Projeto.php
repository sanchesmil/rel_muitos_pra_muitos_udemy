<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    function desenvolvedores(){
        return $this->belongsToMany('App\Desenvolvedor','alocacoes'); // 1º Parm: Modelo que vou retornar, 2º Parm: tabela de vínculo
    }
}
