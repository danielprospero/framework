<?php

class Categoria extends Controller {

    public function __construct(){
        if(!Sessao::estaLogado()){
            URL::redirecionar('usuarios/login');
        }
        $this->categoriaModel = $this->model('CategoriaModel');
        $this->postModel = $this->model('PostModel');
    }

    public function index($slug){

        $categoria = $this->categoriaModel->listarCategoriaPorSlug($slug);

        if($categoria == null){
            Sessao::mensagem('categoria', 'Categoria não encontrada');
            URL::redirecionar('pasgina/error');
        }

        $post = $this->postModel->listarPostPorCategoria($categoria->categoriaId);

        $dados = [
            'categoria' => $categoria,
            'posts' => $post,
        ];

        $this->view('categorias/index', $dados);

    }

    public function cadastrar(){

        $formulario = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

        if(isset($formulario)){

            $dados = [
                'nome' => trim($formulario['nome']),
                'slug' => trim($formulario['slug']),
                'status_categoria_id' => trim($formulario['status_categoria_id']),
            ];

            if(in_array("",$formulario)){

                if(empty($formulario['nome'])){
                    Sessao::mensagem('nome_error', 'Por favor, informe o nome da categoria', 'alert alert-danger');
                }
                if(empty($formulario['slug'])){
                    Sessao::mensagem('slug_error', 'Por favor, informe o slug da categoria', 'alert alert-danger');
                }
                if(empty($formulario['status_categoria_id'])){
                    Sessao::mensagem('status_categoria_id_error', 'Por favor, selecione o status da categoria', 'alert alert-danger');
                }

            } else {
                if($this->categoriaModel->armazenar($dados)){
                    Sessao::mensagem('categoria', 'Categoria cadastrada com sucesso');
                    URL::redirecionar('categorias');
                } else {
                    die("Erro ao armazenar a categoria no banco de dados");
                }
            }

        } else {
            $dados = [
                'nome' => '',
                'slug' => '',
                'status_categoria_id' => '',
            ];
        }

        $this->view('categoria/cadastrar', $dados);
    }

    public function listaPostPorCategoria($slug){
        $dados = [
            'posts' => $this->postModel->listarPostsPorCategoria($slug),
            'categorias' => $this->categoriaModel->listarCategorias(),
        ];
        $this->view('categoria/post', $dados);
    }


}