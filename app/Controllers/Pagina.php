<?php 

class Pagina extends Controller {

    public function __construct() {

        $this->postModel = $this->model('PostModel');
        $this->categoriaModel = $this->model('CategoriaModel');
        $this->usuarioModel = $this->model('UsuarioModel');
        
    }

    public function index() {

        $post = $this->postModel->listarPosts();
        $postrecente = $this->postModel->listarPostsRecentes();
        $categorias = $this->categoriaModel->listarCategorias();
        $seo = $this->usuarioModel->seo(1);

        if($post == null){
            Sessao::mensagem('post', 'Nenhuma postagem encontrada', 'alert alert-danger');
        }
        
        $dados = [
            'posts' => $post,
            'seo' => $seo,
            'postsrecentes' => $postrecente,
            'categorias' => $categorias,
        ];
        
        $this->view('posts/index', $dados);
        
    }

    public function blog() {

        $post = $this->postModel->listarPosts();
        $postrecente = $this->postModel->listarPostsRecentes();
        $categoria = $this->categoriaModel->listarCategorias();

        if($post == null){
            Sessao::mensagem('post', 'Nenhuma postagem encontrada', 'alert alert-danger');
        }
        
        $dados = [
            'posts' => $post,
            'postsrecentes' => $postrecente,
            'categorias' => $categoria,
        ];
        
        $this->view('posts/blog', $dados);

    }

    public function sobre() {
        $dados = [
            'titulo' => 'Página Sobre',
            'descricao' => 'Sobre o framework MVC'
        ];
        $this->view('paginas/sobre' , $dados);
    }

    public function contato() {
        $dados = [
            'titulo' => 'Página Contato',
            'descricao' => 'Contato do framework MVC'
        ];
        $this->view('paginas/contato' , $dados);
    }

    public function error() {
        $dados = [
            'titulo' => 'Página não encontrada',
            'descricao' => 'Erro 404'
        ];
        $this->view('paginas/error' , $dados);
    }
    

}