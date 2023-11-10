<?php 

class Admin extends Controller {

    public function __construct() {

        $this->postModel = $this->model('PostModel');
        $this->categoriaModel = $this->model('CategoriaModel');
        $this->usuarioModel = $this->model('UsuarioModel');

        $admin = $this->usuarioModel->listarAdmin();
        if(!$admin->acesso_id == $_SESSION['usuario_acesso_id']){
            session_destroy();
            URL::redirecionar('./');
        }

    }

    public function index() {

        $categorias = $this->categoriaModel->listarCategorias();
        $posts = $this->postModel->listarPosts();
        $usuarios = $this->usuarioModel->listarUsuarios();
    

        $dados = [
            'categorias' => $categorias,
            'posts' => $posts,
            'usuarios' => $usuarios,
        ];

        $this->view('admin/index', $dados);

    }


   

}