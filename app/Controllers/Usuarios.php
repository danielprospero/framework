<?php

class Usuarios extends Controller{

    public function __construct(){
        $this->usuarioModel = $this->model('Usuario');
    }

    public function perfil($id){
        //busca o usuario no model pelo seu ID
        $usuario = $this->usuarioModel->lerUsuarioPorId($id);

        //recebe os dados do formulario e os filtra
        $formulario = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);
        if (isset($formulario)){
            //define os dados
            $dados = [
                'id' => $id,
                'nome' => trim($formulario['nome']),
                'email' => trim($formulario['email']),
                'senha' => trim($formulario['senha']),
                'biografia' => trim($formulario['biografia']),
            ];
            //checa se o campo de senha está vazio 
            if (empty($formulario['senha'])){
                //define a senha como a senha do usuario no banco de dados
                $dados['senha'] = $usuario->senha;
            }elseif (strlen($formulario['senha']) < 6){
                //checa se a senha tem menos de 6 caracteres
                $dados['senha_erro'] = 'O campo senha deve ter no mínimo 6 caracteres';
            }elseif ($formulario['senha'] != $formulario['confirma_senha']){
                //checa se a senha é diferente da confirmação de senha
            $dados['confirma_senha_erro'] = 'O campo confirmar senha deve ser igual ao campo senha';
            }else{
                //se o campo de senha não estiver vazio codifica a senha
                $dados['senha'] = password_hash($formulario['senha'], PASSWORD_DEFAULT);
            }

            //se a biografia estivar vazia recebe a mesma biografia do banco
            if (empty($formulario['biografia'])){
                $dados['biografia'] = $usuario->biografia;
            }

            //checa se existe campos em branco
            if (in_array("", $dados)){

                if (empty($formulario['nome'])){
                    $dados['nome_erro'] = 'Preencha o campo nome';
                }

                if (empty($formulario['email'])){
                    $dados['email_erro'] = 'Preencha o campo e-mail';
                }

            } else {
                //checa se o email do formulario é igual do usuario no banco de dados
                if ($formulario['email'] == $usuario->email){
                    $this->usuarioModel->atualizar($dados);
                    Sessao::mensagem('usuario', 'Perfil atualizado com sucesso');
                //checa se o email do formulario é diferente do usuario no banco de dados
                } elseif (!$this->usuarioModel->checarEmail($formulario['email'])) {
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
                    Url::redirecionar('posts');
                }

                //define os dados da view
                $dados = [
                    'id' => $usuario->id,
                    'nome' => $usuario->nome,
                    'email' => $usuario->email,
                    'biografia' => $usuario->biografia,
                    'nome_erro' => '',
                    'email_erro' => '',
                    'senha_erro' => ''
                ];

            }   
            //define o arquivo de view 
            $this->view('usuarios/perfil', $dados);
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
                        Url::redirecionar('usuarios/login');
                 
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

        Url::redirecionar('posts');

    }

    public function sair(){
  
        unset($_SESSION['usuario_id']);
        unset($_SESSION['usuario_nome']);
        unset($_SESSION['usuario_email']);
        
        session_destroy();   

        Url::redirecionar('usuarios/login');
        
    }



}