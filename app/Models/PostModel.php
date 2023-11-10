<?php

class PostModel {

    private $db;
    private $tabela = 'posts';

    public function __construct(){
        $this->db = new Database;
    }

    public function listarPosts(){
        $this->db->query("SELECT *,
                            posts.id as postId,
                            usuarios.nome as usuarioNome,
                            usuarios.imagem as usuarioImagem,
                            categorias.categoria as categoriaNome,
                            posts.titulo as postTitulo,
                            posts.descricao as postDescricao,
                            posts.conteudo as postConteudo,
                            posts.imagem as postImagem,
                            posts.slug as postSlug,
                            posts.visitas as postVisitas,
                            posts.criado_em as postDataCadastro,
                            posts.modificado_em as postDataModificado
                            FROM posts
                            INNER JOIN usuarios ON usuarios.id = posts.usuario_id
                            INNER JOIN categorias ON categorias.id = posts.categoria_id
                            ORDER BY posts.id DESC
                            "); 
        return $this->db->resultados();
    }

    public function armazenar($dados){
        $this->db->query("INSERT INTO posts (usuario_id, categoria_id, titulo, descricao, conteudo, imagem ) VALUES (:usuario_id, :categoria_id, :titulo, :descricao, :conteudo, :imagem)");
        $this->db->bind(":usuario_id", $dados['usuario_id']);
        $this->db->bind(":categoria_id", $dados['categoria_id']);
        $this->db->bind(":titulo", $dados['titulo']);
        $this->db->bind(":descricao", $dados['descricao']);
        $this->db->bind(":conteudo", $dados['conteudo']);
        $this->db->bind(":imagem", $dados['imagem']);

        if($this->db->executa()){
            return true;
        } else {
            return false;
        }
    }

    public function atualizar($dados){
        $this->db->query("UPDATE posts SET usuario_id = :usuario_id, categoria_id = :categoria_id, titulo = :titulo, descricao = :descricao, conteudo = :conteudo, imagem = :imagem, slug = :slug, modificado_em = NOW() WHERE id = :id");

        $this->db->bind(":id", $dados['id']);  
        $this->db->bind(":usuario_id", $dados['usuario_id']);
        $this->db->bind(":categoria_id", $dados['categoria_id']);
        $this->db->bind(":titulo", $dados['titulo']);
        $this->db->bind(":descricao", $dados['descricao']);
        $this->db->bind(":conteudo", $dados['conteudo']);
        $this->db->bind(":imagem", $dados['imagem']);
        $this->db->bind(":slug", $dados['slug']);

        if($this->db->executa()){
            return true;
        } else {
            return false;
        }

    }

    public function deletar($id){
        $this->db->query("DELETE FROM posts WHERE id = :id");
        $this->db->bind(":id", $id);

        if($this->db->executa()){
            return true;
        } else {
            return false;
        }
    }

    public function listarPostsRecentes(){
        $this->db->query("SELECT *,
                            posts.id as postId,
                            posts.titulo as postTitulo,
                            posts.imagem as postImagem,
                            posts.criado_em as postDataCadastro,
                            posts.slug as postSlug
                            FROM posts
                            ORDER BY posts.criado_em DESC
                            LIMIT 3
                            "); 
        return $this->db->resultados();
    }

    public function listarPostPorSlug($slug){
        $this->db->query("SELECT *,
                            posts.id as postId,
                            usuarios.nome as usuarioNome,
                            usuarios.imagem as usuarioImagem,
                            usuarios.id as usuarioId,
                            categorias.categoria as categoriaNome,
                            posts.titulo as postTitulo,
                            posts.descricao as postDescricao,
                            posts.conteudo as postConteudo,
                            posts.imagem as postImagem,
                            posts.slug as postSlug,
                            posts.visitas as postVisitas,
                            posts.criado_em as postDataCadastro
                            FROM posts
                            INNER JOIN usuarios ON usuarios.id = posts.usuario_id
                            INNER JOIN categorias ON categorias.id = posts.categoria_id
                            WHERE posts.slug = :slug
                            ");
        $this->db->bind(":slug", $slug);
        return $this->db->resultado();
    }

    public function listarPostPorCategoria($categoria_id){
        $this->db->query("SELECT *,
                            posts.id as postId,
                            usuarios.nome as usuarioNome,
                            usuarios.imagem as usuarioImagem,
                            categorias.categoria as categoriaNome,
                            posts.titulo as postTitulo,
                            posts.descricao as postDescricao,
                            posts.conteudo as postConteudo,
                            posts.imagem as postImagem,
                            posts.slug as postSlug,
                            posts.visitas as postVisitas,
                            posts.criado_em as postDataCadastro
                            FROM posts
                            INNER JOIN usuarios ON usuarios.id = posts.usuario_id
                            INNER JOIN categorias ON categorias.id = posts.categoria_id
                            WHERE posts.categoria_id = :categoria_id
                            ORDER BY posts.id DESC
                            ");
        $this->db->bind(":categoria_id", $categoria_id);
        return $this->db->resultados();

    }

}