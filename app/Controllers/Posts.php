<?php

class Posts extends Controller{

    public function __construct(){
        if(!Sessao::estaLogado()){
            URL::redirecionar('usuarios/login');
        }
        $this->postModel = $this->model('Post');
        $this->usuarioModel = $this->model('Usuario');
    }

    public function index(){

        $dados = [
            'posts' => $this->postModel->listarPosts()
        ];
         
        $this->view('posts/index', $dados);
    }

    public function cadastrar(){
        $formulario = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);
        if(isset($formulario)){
            $dados = [
                'titulo' => trim($formulario['titulo']),
                'texto' => trim($formulario['texto']),
                'usuario_id' => $_SESSION['usuario_id'],
            ];
           
            if (in_array("", $formulario)) {
                if (empty($formulario['titulo'])) {
                    $dados['titulo_erro'] = 'O campo título é obrigatório';
                }
                if (empty($formulario['texto'])) {
                    $dados['texto_erro'] = 'O campo texto é obrigatório';
                }
            }else{
                if($this->postModel->armazenar($dados)){
                    Sessao::mensagem('post', 'Post cadastrado com sucesso');
                    URL::redirecionar('posts');
                }else{
                    die("Erro ao armazenar o post no banco de dados");
                }
            }
        }else{
            $dados = [
                'titulo' => '',
                'texto' => '',
                'titulo_erro' => '',
                'texto_erro' => '',
            ];
        }
        $this->view('posts/cadastrar', $dados);
    }

    public function visualizar($id){
        $post = $this->postModel->lerPostPorId($id);
        $usuario = $this->usuarioModel->lerUsuarioPorId($post->usuario_id);
        $dados = [
            'post' => $post,
            'usuario' => $usuario
        ];
        $this->view('posts/visualizar', $dados);
    }

    public function editar($id){
        $formulario = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);
        if(isset($formulario)){
            $dados = [
                'id' => $id,
                'titulo' => trim($formulario['titulo']),
                'texto' => trim($formulario['texto']),
                'usuario_id' => $_SESSION['usuario_id'],
            ];
           
            if (in_array("", $formulario)) {
                if (empty($formulario['titulo'])) {
                    $dados['titulo_erro'] = 'O campo título é obrigatório';
                }
                if (empty($formulario['texto'])) {
                    $dados['texto_erro'] = 'O campo texto é obrigatório';
                }
            }else{
                if($this->postModel->editar($dados)){
                    Sessao::mensagem('post', 'Post atualizado com sucesso');
                    URL::redirecionar('posts');
                }else{
                    die("Erro ao atualizar o post no banco de dados");
                }
            }
        }else{
            $post = $this->postModel->lerPostPorId($id);
            if($post->usuario_id != $_SESSION['usuario_id']){
                Sessao::mensagem('post', 'Você não tem permissão para editar esse post', 'alert alert-danger');
                URL::redirecionar('posts');
            }
            $dados = [
                'id' => $post->id,
                'titulo' => $post->titulo,
                'texto' => $post->texto,
                'titulo_erro' => '',
                'texto_erro' => '',
            ];
        }
        $this->view('posts/editar', $dados);
    }

    public function deletar($id){
        if($this->postModel->deletar($id)){
            Sessao::mensagem('post', 'Post deletado com sucesso');
            URL::redirecionar('posts');
        }else{
            die("Erro ao deletar o post no banco de dados");
        }
    }
    
}