<?php 

class Post {
    private $db;

    public function __construct(){
        $this->db = new Conexao;
    }

    public function listarPosts(){
        $this->db->query("SELECT *,
                            posts.id as postId,
                            usuarios.id as usuarioId,
                            posts.criado_em as postDataCadastro,
                            usuarios.criado_em as usuarioDataCadastro
                            FROM posts
                            INNER JOIN usuarios ON
                            posts.usuario_id = usuarios.id
                            ORDER BY posts.criado_em DESC
                            ");
        return $this->db->resultados();
    }

    public function armazenar($dados){
        $this->db->query("INSERT INTO posts (usuario_id, titulo, texto) VALUES (:usuario_id, :titulo, :texto)");
        $this->db->bind("usuario_id", $dados['usuario_id']);
        $this->db->bind("titulo", $dados['titulo']);
        $this->db->bind("texto", $dados['texto']);
  

        if($this->db->executa()){
            return true;
        }else{
            return false;
        }
    }

    public function lerPostPorId($id){
        $this->db->query("SELECT *,
                            posts.id as postId,
                            usuarios.id as usuarioId,
                            posts.criado_em as postDataCadastro,
                            usuarios.criado_em as usuarioDataCadastro
                            FROM posts
                            INNER JOIN usuarios ON
                            posts.usuario_id = usuarios.id
                            WHERE posts.id = :id
                            ");
        $this->db->bind("id", $id);
        return $this->db->resultado();
    }

    public function editar($dados){
        $this->db->query("UPDATE posts SET titulo = :titulo, texto = :texto WHERE id = :id");
        $this->db->bind("id", $dados['id']);
        $this->db->bind("titulo", $dados['titulo']);
        $this->db->bind("texto", $dados['texto']);
        if($this->db->executa()){
            return true;
        }else{
            return false;
        }
    }

    public function deletar($id){
        $this->db->query("DELETE FROM posts WHERE id = :id");
        $this->db->bind("id", $id);
        if($this->db->executa()){
            return true;
        }else{
            return false;
        }
    }
}