<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


use App\Desenvolvedor;
use App\Projeto;
use Illuminate\Support\Facades\Route;



Route::get('/desenvolvedor_projetos', function () {
    
    $devs = Desenvolvedor::all();  // Carregamento Tardio = não traz os projetos

    if(count($devs) === 0){
        echo "<h4> Não existem Desenvolvedores cadastrados </h4>";
    }else{
        
        foreach($devs as $dev){
            echo "<h3> Desenvolvedor: </h3>";
            echo "<ul> <li> " . $dev->nome . "</li></ul>";
            $projetos  = $dev->projetos;  // Recupera os projetos

            if(count($projetos) > 0){
                echo "<h4>Projetos do desenvolvedor: </h4>";
                echo "<ul>";
                foreach($dev->projetos as $proj){
                    echo " <li> Nome: <strong>" . $proj->nome . "</strong></li>";
                    echo "<ul> <br>";
                        echo " <li> Total de Horas do Projeto: " . $proj->estimativa_horas . "</li>";
                        echo " <li> Horas semanais do Desenvolvedor: " . $proj->pivot->horas_semanais . " </li>";
                    echo " <br></ul>";
                }
                echo "</ul> <hr>";
            }
        }
    }
});

Route::get('/projeto_desenvolvedores', function () {
    
    $projs = Projeto::with('desenvolvedores')->get(); // Carregamento Ligeiro = já traz os 'desenvolvedores'

    if(count($projs) === 0){
        echo "<h4> Não existem Projetos cadastrados </h4>";
    }else{
        foreach($projs as $proj){
            echo "<h3> Projeto: </h3>";
            echo "<ul> <li> Nome:  <strong>" . $proj->nome . "</strong></li>
                       <li> Horas do Projeto: " . $proj->estimativa_horas . "</li>
                  </ul>";
            $devs  = $proj->desenvolvedores;

            if(count($devs) > 0){
                echo "<h4>Desenvolvedores no Projeto: </h4>";
                echo "<ul>";
                foreach($devs as $dev){
                    echo " <li> Nome: <strong>" .  $dev->nome . "</strong></li>";
                    echo " <li> Cargo: " .  $dev->cargo . "</li>";
                    echo " <li> Horas semanais do Desenvolvedor: " . $dev->pivot->horas_semanais . " </li> <br>";
                }
                echo "</ul> <hr>";
            }
        }
    }
});

// Retorna o Projeto com seus desenvolvedores
Route::get('/projeto_desenvolvedores/json', function(){
    //$projetos1 = Projeto::all();  // Carregamento tardio (Lazy loading) = Não traz os relaciomentos

    $projetos2 = Projeto::with('desenvolvedores')->get(); // Carregamento Rápido (Eager loading) = Traz os dados dos relaciomentos informados

    return $projetos2->toJson();
});

Route::get('/desenvolvedor_projetos/json', function(){
    $devs = Desenvolvedor::with('projetos')->get();

    return $devs->toJson();
});

// Associação de instâncias no relacionamento "MUITOS para MUITOS"
// Usando o método: 'ATTACH'

// Anexar um Desenvolvedor a um Projeto, inserindo um registro na tabela intermediária que une os dois modelos (ALOCACAO)
Route::get('/alocar_desenvolvedor_no_projeto', function(){
    $proj = Projeto::find(1); // Projeto: Sistema Alocação de Recursos

    if(isset($proj)){
        // ASSOCIAR passando uma instância de Desenvolvedor ao Projeto
        // $dev = Desenvolvedor::find(1); // João Goulart
        // $proj->desenvolvedores()->attach($dev,['horas_semanais' => 13]); // 'horas_semanais' = campo da tabela de ligação 'ALOCACAO'
 
        // ou 

        // ASSOCIAR passando o ID diretamente
        //$proj->desenvolvedores()->attach( 3 ,['horas_semanais' => 13]); 

        // ou 

        // ASSOCIAR vários registros ao mesmo tempo usando array de IDs
        $proj->desenvolvedores()->attach([
            1 => ['horas_semanais' => 7],
            2 => ['horas_semanais' => 9],
       ]);

        $proj->load('desenvolvedores'); // Atualiza a instância de Projetos trazendo os desenvolvedores recem associados

        return $proj->toJson();
    }

    $msg = "<h4> O projeto especificado não existe. </h4>";
    return $msg;
});

// Desassociação de instâncias no relacionamento 'MUITOS pra MUITOS'
// Através do método: 'DETACH'
Route::get('/desaloca_desenvolvedor_do_projeto', function(){
    $proj = Projeto::find(3);  // Projeto: Sistema de Vendas

    // DESASSOCIAR usando a instância $dev
    // $dev = Desenvolvedor::find(1); // João Goulart
    // $proj->desenvolvedores()->detach($dev); 
 
    //ou 

    // DESASSOCIAR usando os IDs dos desenvolvedores
    $proj->desenvolvedores()->detach([3,2]);

    $proj->load('desenvolvedores');

    return $proj->toJson();
});