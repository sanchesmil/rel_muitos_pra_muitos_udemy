## Projeto que mostra o relacionamento "Muitos p/ Muitos" no Laravel

O projeto consiste em 3 tabelas:
* DESENVOLVEDOR
* PROJETO
* ALOCACAO
    
- Relacionamento 'n x n':

    '1' DESENVOLVEDOR pode estar ALOCADO a 'N' PROJETOS e 
    '1' PROJETO pode ALOCAR 'N' DESENVOLVEDORES
--------------------------------------------------------------------
Ver o arquivo de rotas 'WEB'.

Nele foram codificadas as formas de ASSOCIAÇÃO e DESASSOCIAÇÃO entre 
as entidades DESENVOLVEDOR e PROJETO na tabela ALOCACAO.

No relacionamento 'MUITOS p/ MUITOS':

* Para ASSOCIAR usa-se o método 'ATTACH'

* Para DESASSOCIAR usa-se o método 'DETACH'

--------------------------------------------------------------------

Como obter os campos da tabela de ligação, chamada de PIVOT pelo Laravel?

* Por padrão, o Laravel não busca os campos da tabela de ligação.

* Para recuperá-los é necessário usar o método "withPivot" na função que estabelece
o relacionamento dentro da Model.

Ex.: função na model 'Projetos' que estabelece o relaciomento 'nxn' com a model 'Desenvolvedor'

    function desenvolvedores(){

        return $this->belongsToMany('App\Desenvolvedor','alocacoes')->withPivot('horas_semanais');  
    }


