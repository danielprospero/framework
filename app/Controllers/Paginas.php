<?php

class Paginas extends Controller{

    public function index(){
        if(Sessao::estaLogado()){
            Url::redirecionar('posts');
        }

        $dados = [
            'tituloPagina' => 'Página Inicial',
            'texto' => 'Bem vindo ao framework MVC'
        ];

        $this->view('paginas/home', $dados);

    }

    public function sobre(){    
        $dados = [
            'tituloPagina' => 'Página Sobre Nós',
            'texto' => 'Sobre o framework MVC'
        ];

        $this->view('paginas/sobre', $dados);

    }

    public function error(){
        $dados = [
            'tituloPagina' => 'Página não encontrada',
            'texto' => 'A página que você está procurando não existe'
        ];

        $this->view('paginas/error', $dados);

    }
    
}
