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
    
    $devs = Desenvolvedor::all();

    if(count($devs) === 0){
        echo "<h4> Não existem Desenvolvedores cadastrados </h4>";
    }else{
        
        foreach($devs as $dev){
            echo "<h3> Desenvolvedor: </h3>";
            echo "<ul> <li> " . $dev->nome . "</li></ul>";
            $projetos  = $dev->projetos;

            if(count($projetos) > 0){
                echo "<h4>Projetos do desenvolvedor: </h4>";
                echo "<ul>";
                foreach($dev->projetos as $proj){
                    echo " <li>" . $proj->nome . " </li>";
                }
                echo "</ul> <hr>";
            }
        }
    }
});

Route::get('/projeto_desenvolvedores', function () {
    
    $projs = Projeto::all();

    if(count($projs) === 0){
        echo "<h4> Não existem Projetos cadastrados </h4>";
    }else{
        foreach($projs as $proj){
            echo "<h3> Projeto: </h3>";
            echo "<ul> <li> " . $proj->nome . "</li></ul>";
            $devs  = $proj->desenvolvedores;

            if(count($devs) > 0){
                echo "<h4>Desenvolvedores no Projeto: </h4>";
                echo "<ul>";
                foreach($devs as $dev){
                    echo " <li>" . $dev->nome . " </li>";
                }
                echo "</ul> <hr>";
            }
        }
    }
});

// Retorna o Projeto com seus desenvolvedores
Route::get('/projeto_desenvolvedores/json', function(){
    $projetos1 = Projeto::all();  // Carregamento tardio (Lazy loading) = Não traz os relaciomentos

    $projetos2 = Projeto::with('desenvolvedores')->get(); // Carregamento Rápido (Eager loading) = Traz os dados dos relaciomentos informados

    return $projetos2->toJson();
});


// 2 FORMAS de Associar Instâncias entre si.

//1ª FORMA: Usando o método 'ASSOCIATE' ( maneira + elegante)

// Associar uma instância de 'Categoria' a um Produto usando o método 'ASSOCIATE'
Route::get('/associarcategorianoproduto', function(){
    $cat = Categoria::find(3); // Categoria informática

    $p = new Produto();
    $p->nome = "Meu novo Produto";
    $p->preco = 99.99;
    $p->estoque = 100;
    $p->categoria()->associate($cat); // Associa uma instância de categoria ao produto
    $p->save();

    return $p->toJson();
});

// Desassociar uma 'Categoria' de um Produto usando o método 'DISSOCIATE'
Route::get('/desassociarcategoriadeproduto', function(){
    $p = Produto::find(9);
    if(isset($p)){
        $p->categoria()->dissociate(); // Desassocia a instância de categoria do produto
        $p->save();

        return $p->toJson();
    }
    return '';
});

// 2ª FORMA de Associação: Usando o método 'SAVE()' 

// Associar um Produto a uma 'Categoria' usando o método SAVE()
Route::get('/adicionarprodutonacategoria/{cat_id}', function($cat_id){

    $cat = Categoria::with('produtos')->find($cat_id);  //Retorna a Categoria especificada com seus Produtos

    $prod = new Produto();
    $prod->nome = "Novo produto via Categoria";
    $prod->preco = 43.98;
    $prod->estoque = 50;

    if(isset($cat)){
        $cat->produtos()->save($prod);  // Associa uma instância de produto à categoria
    }

    $cat->load('produtos'); // Atualiza a lista de produtos na instância de Categorias

    return $cat->toJson();
    
});