<?php

class Paginas extends Controller{

    public function index(){
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
    
}
