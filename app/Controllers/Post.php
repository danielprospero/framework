<?php 

class Post extends Controller {

    public function __construct() {

        $this->postModel = $this->model('PostModel');
        $this->categoriaModel = $this->model('CategoriaModel');
        $this->usuarioModel = $this->model('UsuarioModel');

    }

    public function index($slug) {

        $post = $this->postModel->listarPostPorSlug($slug);

        if($post == null){
            Sessao::mensagem('post', 'Post não encontrado');
            URL::redirecionar('pasgina/error');
        }

        $categoria = $this->categoriaModel->listarCategoriaPorId($post->categoria_id);
        $categorias = $this->categoriaModel->listarCategorias();
        $postsrecentes = $this->postModel->listarPostsRecentes();
        $seo = $this->usuarioModel->seo(1);

        $dados = [
            'post' => $post,
            'seo' => $seo,
            'postsrecentes' => $postsrecentes,
            'categorias' => $categorias,
            'categoria' => $categoria,
        ];

        $this->view('posts/ver', $dados);


    }

    public function cadastrar(){

        $formulario = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

        if(isset($formulario)){

            $categorias = $this->categoriaModel->listarCategorias();

            $dados = [
                'usuario_id' => $_SESSION['usuario_id'],
                'categoria_id' => trim($formulario['categoria_id']),
                'titulo' => trim($formulario['titulo']),
                'descricao' => trim($formulario['descricao']),
                'conteudo' => trim($formulario['conteudo']),
                'imagem' => $_FILES['imagem']['name'],
                'categoria' => $categoria,

            ];

            if(in_array("",$formulario)){

                if(empty($formulario['titulo'])){
                    Sessao::mensagem('titulo_error', 'Por favor, informe o titulo da postagem', 'alert alert-danger');
                }
                if(empty($formulario['descricao'])){
                    Sessao::mensagem('descricao_error', 'Por favor, informe a descrição da postagem', 'alert alert-danger');
                }
                if(empty($formulario['conteudo'])){
                    Sessao::mensagem('conteudo_error', 'Por favor, informe o conteúdo da postagem', 'alert alert-danger');
                }
                if(empty($formulario['categoria_id'])){
                    Sessao::mensagem('categoria_id_error', 'Por favor, selecione a categoria da postagem', 'alert alert-danger');
                }
                if(empty($_FILES['imagem']['name'])){
                    Sessao::mensagem('imagem_error', 'Por favor, selecione uma imagem', 'alert alert-danger');
                }

            } else {
                if($this->postModel->armazenar($dados)){
                    Sessao::mensagem('post', 'Postagem cadastrada com sucesso');
                    URL::redirecionar('posts');
                } else {
                    die("Erro ao armazenar o post no banco de dados");
                }
            }

        } else {

            $categorias = $this->categoriaModel->listarCategorias();

            $dados = [
                'usuario_id' => '',
                'categoria_id' => '',
                'titulo' => '',
                'descricao' => '',
                'conteudo' => '',
                'imagem' => '',
                'categorias' => $categorias,
                'usuario_id_error' => '',
                'categoria_id_error' => '',
                'titulo_error' => '',
                'descricao_error' => '',
                'conteudo_error' => '',
                'imagem_error' => '',
                'catergorias_error' => '',
            ];

        }

        $this->view('posts/cadastrar', $dados);

    }

    public function editar($slug){

        $formulario = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

        if(isset($formulario)){

            $categorias = $this->categoriaModel->listarCategorias();

            $dados = [
                'usuario_id' => $_SESSION['usuario_id'],
                'categoria_id' => trim($formulario['categoria_id']),
                'titulo' => trim($formulario['titulo']),
                'descricao' => trim($formulario['descricao']),
                'conteudo' => trim($formulario['conteudo']),
                'imagem' => $_FILES['imagem']['name'],
                'slug' => $slug,
                'modificado_em' => date('Y-m-d H:i:s'),
                'categorias' => $categorias,
            ];

            if(in_array("",$formulario)){

                if(empty($formulario['titulo'])){
                    Sessao::mensagem('titulo_error', 'Por favor, informe o titulo da postagem', 'alert alert-danger');
                }
                if(empty($formulario['descricao'])){
                    Sessao::mensagem('descricao_error', 'Por favor, informe a descrição da postagem', 'alert alert-danger');
                }
                if(empty($formulario['conteudo'])){
                    Sessao::mensagem('conteudo_error', 'Por favor, informe o conteúdo da postagem', 'alert alert-danger');
                }
                if(empty($formulario['categoria_id'])){
                    Sessao::mensagem('categoria_id_error', 'Por favor, selecione a categoria da postagem', 'alert alert-danger');
                }
                if(empty($_FILES['imagem']['name'])){
                    Sessao::mensagem('imagem_error', 'Por favor, selecione uma imagem', 'alert alert-danger');
                }

            } else {
                if($this->postModel->atualizar($dados)){
                    Sessao::mensagem('post', 'Postagem atualizada com sucesso');
                    URL::redirecionar('posts');
                } else {
                    die("Erro ao autualizar o post no banco de dados");
                }
            }

        } else {

            $post = $this->postModel->listarPostPorSlug($slug);
            $categoria = $this->categoriaModel->listarCategoriaPorId($post->categoria_id);
            $categorias = $this->categoriaModel->listarCategorias();

            if($post->usuario_id != $_SESSION['usuario_id']){
                Sessao::mensagem('post', 'Você não tem permissão para editar essa postagem', 'alert alert-danger');
                URL::redirecionar('posts');
            }

            $dados = [
                'id' => $post->postId,
                'usuario_id' => $post->usuarioNome,
                'categoria_id' => $categoria->categoriaNome,
                'titulo' => $post->postTitulo,
                'descricao' => $post->postDescricao,
                'conteudo' => $post->postConteudo,
                'imagem' => $post->postImagem,
                'slug' => $post->postSlug,
                'categorias' => $categorias,
                'modificado_em' => '',
                'usuario_id_error' => '',
                'categoria_id_error' => '',
                'titulo_error' => '',
                'descricao_error' => '',
                'conteudo_error' => '',
                'imagem_error' => '',
                'slug_error' => '',
                'modificado_em_error' => '',
                'catergorias_error' => '',
            ];

        }

        $this->view('posts/editar', $dados);

    }

    public function deletar($slug){

        $slug = filter_var($slug, FILTER_SANITIZE_STRING);
        $metodo = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);

        $post = $this->postModel->listarPostPorSlug($slug);

        if(!$slug || $metodo != 'POST'){
            Session::mensagem('post', 'Método não permitido', 'alert alert-danger');
            URL::redirecionar('posts');
        }

        if($post->usuario_id != $_SESSION['usuario_id']){
            Sessao::mensagem('post', 'Você não tem permissão para deletar essa postagem', 'alert alert-danger');
            URL::redirecionar('posts');
        }

        if($this->postModel->deletar($post->postId)){
            Sessao::mensagem('post', 'Postagem deletada com sucesso');
            URL::redirecionar('posts');
        } else {
            die("Erro ao deletar o post no banco de dados");
        }
    }


    public function ver($slug) {

        $post = $this->postModel->listarPostPorSlug($slug);

        if($post == null){
            Sessao::mensagem('post', 'Post não encontrado');
            URL::redirecionar('pasgina/error');
        }

        $categoria = $this->categoriaModel->listarCategoriaPorId($post->categoria_id);
        $categorias = $this->categoriaModel->listarCategorias();
        $postsrecentes = $this->postModel->listarPostsRecentes();
        $seo = $this->usuarioModel->seo(1);

        $dados = [
            'post' => $post,
            'seo' => $seo,
            'postsrecentes' => $postsrecentes,
            'categorias' => $categorias,
            'categoria' => $categoria,
        ];

        $this->view('posts/ver', $dados);

    }


}