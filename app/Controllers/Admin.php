<?php 

class Admin extends Controller {

    public function __construct() {

        $this->postModel = $this->model('PostModel');
        $this->categoriaModel = $this->model('CategoriaModel');
        $this->usuarioModel = $this->model('UsuarioModel');

        //adiciona os metodos do model as variaveis 
        $this->posts = $this->postModel->listarPosts();
        $this->categorias = $this->categoriaModel->listarCategorias();

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

    public function cadastrar($tipo){
        if($tipo == 'post'){
            $this->cadastrarPost();
        }elseif($tipo == 'categoria'){
            $this->cadastrarCategoria();
        }elseif($tipo == 'usuario'){
            $this->cadastrarUsuario();
        }else{
            URL::redirecionar('pagina/error');
        }
    }

    public function editar($tipo, $id){
        if($tipo == 'post'){
            $this->editarPost($id);
        }elseif($tipo == 'categoria'){
            $this->editarCategoria($id);
        }elseif($tipo == 'usuario'){
            $this->editarUsuario($id);
        }else{
            URL::redirecionar('pagina/error');
        }
    }

    public function deletar($tipo, $id){
        if($tipo == 'post'){
            $this->deletarPost($id);
        }elseif($tipo == 'categoria'){
            $this->deletarCategoria($id);
        }elseif($tipo == 'usuario'){
            $this->deletarUsuario($id);
        }else{
            URL::redirecionar('pagina/error');
        }
    }

    public function cadastrarPost(){
        $formulario = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if(isset($formulario)){
            $dados = [
                'titulo' => trim($formulario['titulo']),
                'slug' => trim($formulario['slug']),
                'descricao' => trim($formulario['descricao']),
                'categoria_id' => trim($formulario['categoriaNome']),
                'status_post_id' => trim($formulario['status_post_id']),
                'imagem' => $_FILES['imagem'],
                'categoria_error' => '',
                'titulo_error' => '',
                'slug_error' => ''
            ];

            if(in_array("",$formulario)){
                if(empty($formulario['titulo'])){
                    $dados['titulo_error'] = 'Por favor, informe o título do post';
                }
                if(empty($formulario['slug'])){
                    $dados['slug_error'] = 'Por favor, informe o slug do post';
                }
                if(empty($formulario['categoria_id'])){
                    $dados['categoria_error'] = 'Por favor, selecione a categoria do post';
                }
            }else{
                if($this->postModel->armazenar($dados)){
                    Sessao::mensagem('post', 'Post cadastrado com sucesso');
                    URL::redirecionar('admin');
                }else{
                    die("Erro ao armazenar o post no banco de dados");
                }
            }
        }else{
            $dados = [
                'titulo' => '',
                'slug' => '',
                'descricao' => '',
                'conteudo' => '',
                'categorias' => $this->categorias,
                'status_post_id' => '',
                'imagem' => '',
                'categoria_error' => '',
                'titulo_error' => '',
                'slug_error' => ''
            ];
        }

        $this->view('admin/posts/cadastrar', $dados);
    }

    private function cadastrarCategoria(){
        $formulario = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);
        if(isset($formulario)){
            $dados = [
                'nome' => trim($formulario['nome']),
                'slug' => trim($formulario['slug']),
                'status_categoria_id' => trim($formulario['status_categoria_id']),
                'nome_error' => '',
                'slug_error' => '',
                'status_categoria_id_error' => ''
            ];

            if(in_array("",$formulario)){
                if(empty($formulario['nome'])){
                    $dados['nome_error'] = 'Por favor, informe o nome da categoria';
                }
                if(empty($formulario['slug'])){
                    $dados['slug_error'] = 'Por favor, informe o slug da categoria';
                }
                if(empty($formulario['status_categoria_id'])){
                    $dados['status_categoria_id_error'] = 'Por favor, selecione o status da categoria';
                }
            }else{
                if($this->categoriaModel->armazenar($dados)){
                    Sessao::mensagem('categoria', 'Categoria cadastrada com sucesso');
                    URL::redirecionar('admin');
                }else{
                    die("Erro ao armazenar a categoria no banco de dados");
                }
            }
        }else{
            $dados = [
                'nome' => '',
                'slug' => '',
                'status_categoria_id' => '',
                'nome_error' => '',
                'slug_error' => '',
                'status_categoria_id_error' => ''
            ];
        }
        $this->view('admin/categoria/cadastrar', $dados);
    }

    private function cadastrarUsuario(){
        $formulario = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);
        if(isset($formulario)){
            $dados = [
                'nome' => trim($formulario['nome']),
                'email' => trim($formulario['email']),
                'senha' => trim($formulario['senha']),
                'acesso_id' => trim($formulario['acesso_id']),
                'status_usuario_id' => trim($formulario['status_usuario_id']),
                'nome_error' => '',
                'email_error' => '',
                'senha_error' => '',
                'acesso_id_error' => '',
                'status_usuario_id_error' => ''
            ];

            if(in_array("",$formulario)){
                if(empty($formulario['nome'])){
                    $dados['nome_error'] = 'Por favor, informe o nome do usuário';
                }
                if(empty($formulario['email'])){
                    $dados['email_error'] = 'Por favor, informe o email do usuário';
                }
                if(empty($formulario['senha'])){
                    $dados['senha_error'] = 'Por favor, informe a senha do usuário';
                }
                if(empty($formulario['acesso_id'])){
                    $dados['acesso_id_error'] = 'Por favor, selecione o acesso do usuário';
                }
                if(empty($formulario['status_usuario_id'])){
                    $dados['status_usuario_id_error'] = 'Por favor, selecione o status do usuário';
                }
            }else{
                if($this->usuarioModel->armazenar($dados)){
                    Sessao::mensagem('usuario', 'Usuário cadastrado com sucesso');
                    URL::redirecionar('admin');
                }else{
                    die("Erro ao armazenar o usuário no banco de dados");
                }
            }
        }else{
            $dados = [
                'nome' => '',
                'email' => '',
                'senha' => '',
                'acesso_id' => '',
                'status_usuario_id' => '',
                'nome_error' => '',
                'email_error' => '',
                'senha_error' => '',
                'acesso_id_error' => '',
                'status_usuario_id_error' => ''
            ];
        }
        $this->view('admin/usuario/cadastrar', $dados);
    }

    private function editarPost($slug){
        $formulario = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if(isset($formulario)){
            $dados = [
                'id' => $id,
                'titulo' => trim($formulario['titulo']),
                'slug' => trim($formulario['slug']),
                'conteudo' => trim($formulario['conteudo']),
                'categoria_id' => trim($formulario['categoria']),
                'status_post_id' => trim($formulario['status_post_id']),
                'imagem' => $_FILES['imagem'],
                'categoria_error' => '',
                'titulo_error' => '',
                'slug_error' => ''
            ];

            if(in_array("",$formulario)){
                if(empty($formulario['titulo'])){
                    $dados['titulo_error'] = 'Por favor, informe o título do post';
                }
                if(empty($formulario['slug'])){
                    $dados['slug_error'] = 'Por favor, informe o slug do post';
                }
                if(empty($formulario['categoria_id'])){
                    $dados['categoria_error'] = 'Por favor, selecione a categoria do post';
                }
            }else{
                if($this->postModel->atualizar($dados)){
                    Sessao::mensagem('post', 'Post atualizado com sucesso');
                    URL::redirecionar('admin');
                }else{
                    die("Erro ao atualizar o post no banco de dados");
                }
            }
        }else{
            $post = $this->postModel->listarPostPorSlug($slug);
            $dados = [
                'id' => $post->postId,
                'titulo' => $post->postTitulo,
                'descricao' => $post->postDescricao,
                'slug' => $post->postSlug,
                'conteudo' => $post->postConteudo,
                'categoria_id' => $post->categoriaId,
                'imagem' => $post->postImagem,
                'categoria_error' => '',
                'titulo_error' => '',
                'slug_error' => ''
            ];
        }

        $this->view('admin/posts/editar', $dados);
    }

    private function editarCategoria($id){
        $formulario = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if(isset($formulario)){
            $dados = [
                'id' => $id,
                'nome' => trim($formulario['nome']),
                'slug' => trim($formulario['slug']),
                'status_categoria_id' => trim($formulario['status_categoria_id']),
                'nome_error' => '',
                'slug_error' => '',
                'status_categoria_id_error' => ''
            ];

            if(in_array("",$formulario)){
                if(empty($formulario['nome'])){
                    $dados['nome_error'] = 'Por favor, informe o nome da categoria';
                }
                if(empty($formulario['slug'])){
                    $dados['slug_error'] = 'Por favor, informe o slug da categoria';
                }
                if(empty($formulario['status_categoria_id'])){
                    $dados['status_categoria_id_error'] = 'Por favor, selecione o status da categoria';
                }
            }else{
                if($this->categoriaModel->atualizar($dados)){
                    Sessao::mensagem('categoria', 'Categoria atualizada com sucesso');
                    URL::redirecionar('admin');
                }else{
                    die("Erro ao atualizar a categoria no banco de dados");
                }
            }
        }else{
            $categoria = $this->categoriaModel->lerCategoriaPorId($id);
            $dados = [
                'id' => $categoria->categoriaId,
                'nome' => $categoria->categoriaNome,
                'slug' => $categoria->categoriaSlug,
                'status_categoria_id' => $categoria->statusCategoriaId,
                'nome_error' => '',
                'slug_error' => '',
                'status_categoria_id_error' => ''
            ];
        }
    }

    private function editarUsuario($id){
        $formulario = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if(isset($formulario)){
            $dados = [
                'id' => $id,
                'nome' => trim($formulario['nome']),
                'email' => trim($formulario['email']),
                'senha' => trim($formulario['senha']),
                'acesso_id' => trim($formulario['acesso_id']),
                'status_usuario_id' => trim($formulario['status_usuario_id']),
                'nome_error' => '',
                'email_error' => '',
                'senha_error' => '',
                'acesso_id_error' => '',
                'status_usuario_id_error' => ''
            ];

            if(in_array("",$formulario)){
                if(empty($formulario['nome'])){
                    $dados['nome_error'] = 'Por favor, informe o nome do usuário';
                }
                if(empty($formulario['email'])){
                    $dados['email_error'] = 'Por favor, informe o email do usuário';
                }
                if(empty($formulario['senha'])){
                    $dados['senha_error'] = 'Por favor, informe a senha do usuário';
                }
                if(empty($formulario['acesso_id'])){
                    $dados['acesso_id_error'] = 'Por favor, selecione o acesso do usuário';
                }
                if(empty($formulario['status_usuario_id'])){
                    $dados['status_usuario_id_error'] = 'Por favor, selecione o status do usuário';
                }
            }else{
                if($this->usuarioModel->atualizar($dados)){
                    Sessao::mensagem('usuario', 'Usuário atualizado com sucesso');
                    URL::redirecionar('admin');
                }else{
                    die("Erro ao atualizar o usuário no banco de dados");
                }
            }
        }else{
            $usuario = $this->usuarioModel->lerUsuarioPorId($id);
            $dados = [
                'id' => $usuario->usuarioId,
                'nome' => $usuario->usuarioNome,
                'email' => $usuario->usuarioEmail,
                'senha' => $usuario->usuarioSenha,
                'acesso_id' => $usuario->acessoId,
                'status_usuario_id' => $usuario->statusUsuarioId,
                'nome_error' => '',
                'email_error' => '',
                'senha_error' => '',
                'acesso_id_error' => '',
                'status_usuario_id_error' => ''
            ];
        }

        $this->view('admin/usuario/editar', $dados);

    }

    private function deletarPost($id){
        if($this->postModel->deletar($id)){
            Sessao::mensagem('post', 'Post deletado com sucesso');
            URL::redirecionar('admin');
        }else{
            die("Erro ao deletar o post no banco de dados");
        }
    }

    private function deletarCategoria($id){
        if($this->categoriaModel->deletar($id)){
            Sessao::mensagem('categoria', 'Categoria deletada com sucesso');
            URL::redirecionar('admin');
        }else{
            die("Erro ao deletar a categoria no banco de dados");
        }
    }

    private function deletarUsuario($id){
        if($this->usuarioModel->deletar($id)){
            Sessao::mensagem('usuario', 'Usuário deletado com sucesso');
            URL::redirecionar('admin');
        }else{
            die("Erro ao deletar o usuário no banco de dados");
        }
    }

}