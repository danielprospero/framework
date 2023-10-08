<?php

class Usuarios extends Controller{

    public function __construct(){
        $this->usuarioModel = $this->model('Usuario');
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
           
            if (in_array("", $formulario)) {
                if (empty($formulario['nome'])) {
                    $dados['nome_erro'] = 'O campo nome é obrigatório';
                }
                if (empty($formulario['email'])) {
                    $dados['email_erro'] = 'O campo email é obrigatório';
                }
                if (empty($formulario['senha'])) {
                    $dados['senha_erro'] = 'O campo senha é obrigatório';
                }
                if (empty($formulario['confirma_senha'])) {
                    $dados['confirma_senha_erro'] = 'O campo confirmar senha é obrigatório';
                }
                if (empty($formulario['termos'])) {
                    $dados['termos_erro'] = 'O campo termos é obrigatório';
                }
            }else{
                if(Validar::verificaNome($formulario['nome'])){
                    $dados['nome_erro'] = 'O campo nome não pode conter caracteres especiais';
                }elseif (Validar::verificaEmail($formulario['email'])) {
                    $dados['email_erro'] = 'O campo email não é válido';
                }elseif($this->usuarioModel->verificarEmailExiste($formulario['email'])){
                    $dados['email_erro'] = 'O campo email já está cadastrado';
                }elseif(strlen($formulario['senha']) < 6) {
                    $dados['senha_erro'] = 'O campo senha deve ter no mínimo 6 caracteres';
                }elseif ($formulario['senha'] != $formulario['confirma_senha']) {
                    $dados['confirma_senha_erro'] = 'O campo confirmar senha deve ser igual ao campo senha';
                }elseif (empty($formulario['termos'])) {
                    $dados['termos_erro'] = 'O campo termos é obrigatório';
                }else{
                    $dados['senha'] = password_hash($formulario['senha'], PASSWORD_DEFAULT);

                    if($this->usuarioModel->armazenar($dados)){
 
                        Sessao::mensagem('usuario', 'Usuário cadastrado com sucesso');
                        URL::redirecionar('usuarios/login');
                 
                    }else{
                        die("Erro ao armazenar o usuário no banco de dados");
                    }
                }
            }
        
      
        }else{
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
           
            if (in_array("", $formulario)) {
                if (empty($formulario['email'])) {
                    $dados['email_erro'] = 'O campo email é obrigatório';
                }
                if (empty($formulario['senha'])) {
                    $dados['senha_erro'] = 'O campo senha é obrigatório';
                }
            }else{
                if (Validar::verificaEmail($formulario['email'])) {
                    $dados['email_erro'] = 'O campo email não é válido';
                }elseif(strlen($formulario['senha']) < 6) {
                    $dados['senha_erro'] = 'O campo senha deve ter no mínimo 6 caracteres';
                }else{
                    $usuario = $this->usuarioModel->verificarLogin($formulario['email'], $formulario['senha']);
                    if($usuario){
                        $this->criarSessaoUsuario($usuario);
                    }else{
                        $dados['senha_erro'] = 'Usuário ou senha inválidos';
                    }
                }
            }
        
      
        }else{
            $dados = [
                'email' => '',
                'senha' => '',
                'email_erro' => '',
                'senha_erro' => '',
            ];
        }

        $this->view('usuarios/login', $dados);
    }

    private function criarSessaoUsuario($usuario){

        $_SESSION['usuario_id'] = $usuario->id;
        $_SESSION['usuario_nome'] = $usuario->nome;
        $_SESSION['usuario_email'] = $usuario->email;

        URL::redirecionar('posts');

    }

    public function sair(){
  
        unset($_SESSION['usuario_id']);
        unset($_SESSION['usuario_nome']);
        unset($_SESSION['usuario_email']);
        
        session_destroy();   

        URL::redirecionar('usuarios/login');
        
    }



}