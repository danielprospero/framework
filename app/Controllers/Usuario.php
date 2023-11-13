<?php

class Usuario extends Controller{

    public function __construct(){
        $this->usuarioModel = $this->model('UsuarioModel');
    }

    public function cadastrar(){

        $formulario = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

        if(isset($formulario)){

            $dados = [
                'nome' => trim($formulario['nome']),
                'email' => trim($formulario['email']),
                'senha' => trim($formulario['senha']),
                'confirma_senha' => trim($formulario['confirma_senha']),
                'termos' => trim($formulario['termos']),
            ];

            if(in_array("",$formulario)){

                if(empty($formulario['nome'])){
                    Sessao::mensagem('nome_erro', 'Por favor, informe o nome do usuário', 'alert alert-danger');
                }
                if(empty($formulario['email'])){
                    Sessao::mensagem('email_erro', 'Por favor, informe o email do usuário', 'alert alert-danger');
                }
                if(empty($formulario['senha'])){
                    Sessao::mensagem('senha_erro', 'Por favor, informe a senha do usuário', 'alert alert-danger');
                } 
                if(empty($formulario['confirma_senha'])){
                    Sessao::mensagem('confirma_senha_erro', 'Por favor, confirme a senha do usuário', 'alert alert-danger');
                } 

            } else {

                if(Checa::checarNome($formulario['nome'])){
                    Sessao::mensagem('nome_erro', 'O nome deve conter apenas letras e espaços', 'alert alert-danger');
                }elseif(strlen($formulario['nome']) < 3){
                    Sessao::mensagem('nome_erro', 'O nome deve ter pelo menos 3 caracteres', 'alert alert-danger');
                }elseif(Checa::checarEmail($formulario['email'])){
                    Sessao::mensagem('email_erro', 'O email informado é inválido', 'alert alert-danger');
                }elseif($this->usuarioModel->checarEmail($formulario['email'])){
                    Sessao::mensagem('email_erro', 'O email informado já está cadastrado', 'alert alert-danger');
                }elseif(strlen($formulario['email']) < 6){
                    Sessao::mensagem('email_erro', 'O email deve ter pelo menos 6 caracteres', 'alert alert-danger');
                }elseif($formulario['senha'] != $formulario['confirma_senha']){
                    Sessao::mensagem('confirma_senha_erro', 'As senhas não conferem', 'alert alert-danger');
                }elseif(empty($formulario['termos'])){
                    Sessao::mensagem('termos_erro', 'Por favor, aceite os termos e condições', 'alert alert-danger');
                }else{

                    $dados['senha'] = password_hash($formulario['senha'], PASSWORD_DEFAULT);

                    if($this->usuarioModel->armazenar($dados)){
                        Sessao::mensagem('usuario', 'Usuário cadastrado com sucesso');
                        URL::redirecionar('usuarios/login');
                    } else {
                        die("Erro ao cadastrar o usuário");
                    }
                }
            }

        } else {

            $dados = [
                'nome' => '',
                'email' => '',
                'senha' => '',
                'confirma_senha' => '',
                'termos' => '',
                'nome_erro' => '',
                'email_erro' => '',
                'senha_erro' => '',
                'confirma_senha_erro' => '',
                'termos_erro' => '',
            ];

        }

        $this->view('usuarios/cadastrar', $dados);

    }

    public function login(){

        $formulario = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

        if(isset($formulario)){

            $dados = [
                'email' => trim($formulario['email']),
                'senha' => trim($formulario['senha']),
            ];

            if(in_array("",$formulario)){

                if(empty($formulario['email'])){
                    Sessao::mensagem('email_erro', 'Por favor, informe o email do usuário', 'alert alert-danger');
                }
                if(empty($formulario['senha'])){
                    Sessao::mensagem('senha_erro', 'Por favor, informe a senha do usuário', 'alert alert-danger');
                }

            } else {

                if(Checa::checarEmail($formulario['email'])){
                    sessao::mensagem('email_erro', 'O email informado é inválido', 'alert alert-danger');
                }else{

                    $usuario = $this->usuarioModel->checarLogin($formulario['email'], $formulario['senha']);

                    if($usuario){
                        $this->criarSessaoUsuario($usuario);
                        URL::redirecionar('posts');
                    } else {
                        Sessao::mensagem('senha_email_erro', 'Usuário ou senha inválidos', 'alert alert-danger');
                    }
                }
            }

        } else {

            $dados = [

                'email' => '',
                'senha' => '',
                'email_erro' => '',
                'senha_erro' => '',
                'senha_email_erro' => '',

            ];

        }

        $this->view('usuarios/login', $dados);

    }

    private function criarSessaoUsuario($usuario){

        $_SESSION['usuario_id'] = $usuario->id;
        $_SESSION['usuario_nome'] = $usuario->nome;
        $_SESSION['usuario_email'] = $usuario->email;
        $_SESSION['usuario_imagem'] = $usuario->imagem;
        $_SESSION['usuario_acesso_id'] = $usuario->acesso_id;

        URL::redirecionar('posts');

    }

    public function sair(){

        unset($_SESSION['usuario_id']);
        unset($_SESSION['usuario_nome']);
        unset($_SESSION['usuario_email']);

        session_destroy();

        URL::redirecionar('usuarios/login');

    }

    public function perfil($id = null){
        //busca o usuario no model pelo seu ID
        $usuario = $this->usuarioModel->listarUsuarioPorId($id);

        //recebe os dados do formulario e os filtra
        $formulario = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);
        if (isset($formulario)){
            //define os dados
            $dados = [
                'id' => $id,
                'nome' => trim($formulario['nome']),
                'email' => trim($formulario['email']),
                'senha' => trim($formulario['senha']),
                'imagem' => $_FILES['imagem']['name'],
                'biografia' => trim($formulario['biografia']),
                'nome_erro' => '',
                'email_erro' => '',
                'senha_erro' => ''
            ];
            //checa se o campo de senha está vazio 
            if(empty($formulario['senha'])) {
                //define a senha como a senha do usuario no banco de dados
                $dados['senha'] = $usuario->senha;
            }else{
                //se o campo de senha não estiver vazio codifica a senha
                $dados['senha'] = password_hash($formulario['senha'], PASSWORD_DEFAULT);
            }

            //se a biografia estivar vazia recebe a mesma biografia do banco
            if (empty($formulario['biografia'])){
                $dados['biografia'] = $usuario->biografia;
            }

            //checa se existe campos em branco
            if(empty($formulario['nome']) || empty($formulario['email'])){

                if (empty($formulario['nome'])){
                    $dados['nome_erro'] = 'Preencha o campo nome';
                }

                if (empty($formulario['email'])){
                    $dados['email_erro'] = 'Preencha o campo e-mail';
                }

            }else{
                //checa se o email do formulario é igual do usuario no banco de dados
                if($formulario['email'] == $usuario->email){
                    $this->usuarioModel->atualizar($dados);
                    Sessao::mensagem('usuario', 'Perfil atualizado com sucesso');
                //checa se o e-mail não está cadastrado no banco de dados
                }elseif(!$this->usuarioModel->checarEmail($formulario['email'])){
                    $this->usuarioModel->atualizar($dados);
                    Sessao::mensagem('usuario', 'Perfil atualizado com sucesso');
                }else{
                    $dados['email_erro'] = 'O e-mail informado já está cadastrado';
                }
            }
        }else{
            //verifica se o usuario tem autorização para editar seu perfil
            if ($usuario->id != $_SESSION['usuario_id']){
                Sessao::mensagem('post', 'Você não tem autorização para editar esse perfil', 'alert alert-danger');
                URL::redirecionar('posts');
            }

            //define os dados da view
            $dados = [
                'id' => $usuario->id,
                'nome' => $usuario->nome,
                'email' => $usuario->email,
                'imagem' => $usuario->imagem,
                'biografia' => $usuario->biografia,
                'nome_erro' => '',
                'email_erro' => '',
                'senha_erro' => ''
            ];

        }
        //define o arquivo de view 

        $this->view('usuarios/perfil', $dados);
    }

    public function index(){

        $usuarios = $this->usuarioModel->listarUsuarios();

        $dados = [
            'usuarios' => $usuarios,
        ];

        $this->view('usuarios/index', $dados);

    }


}