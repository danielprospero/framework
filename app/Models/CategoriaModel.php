<?php 

class CategoriaModel {

    private $db;
    private $tabela = 'categorias';

    public function __construct(){
        $this->db = new Database;
    }

    public function armazenar($dados){
        
        $this->db->query("INSERT INTO {$this->tabela} (nome), (slug), (status_categoria_id) VALUES (:nome), (:slug), (:status_categoria_id)");
        $this->db->bind(":nome", $dados['nome']);
        $this->db->bind(":slug", $dados['slug']);
        $this->db->bind(":status_categoria_id", $dados['status_categoria_id']);

        if($this->db->executa()){
            return true;
        } else {
            return false;
        }
    }

    public function atualizar($dados){
        
        $this->db->query("UPDATE {$this->tabela} SET nome = :nome, slug = :slug, status_categoria_id = :status_categoria_id, modified = NOW() WHERE id = :id");
        $this->db->bind(":id", $dados['id']);
        $this->db->bind(":nome", $dados['nome']);
        $this->db->bind(":slug", $dados['slug']);
        $this->db->bind(":status_categoria_id", $dados['status_categoria_id']);
        $this->db->bind(":modified", $dados['modified']);

        if($this->db->executa()){
            return true;
        } else {
            return false;
        }
    }

    public function deletar($id){
        $this->db->query("DELETE FROM {$this->tabela} WHERE id = :id");
        $this->db->bind(":id", $id);
        if($this->db->executa()){
            return true;
        } else {
            return false;
        }
    }


    public function listarCategorias(){
        $this->db->query("SELECT *,
                            categorias.id as categoriaId,
                            categorias.categoria as categoriaNome,
                            categorias.slug as categoriaSlug,
                            status_categorias.nome as statusCategoriaNome,
                            categorias.criado_em as categoriaCriado,
                            categorias.modificado_em as categoriaModificado
                            FROM categorias
                            INNER JOIN status_categorias ON status_categorias.id = categorias.status_categoria_id
                            ORDER BY categorias.categoria ASC
                            "); 
        return $this->db->resultados();
    }

    public function listarCategoriaPorId($id){
        $this->db->query("SELECT *,
                            categorias.id as categoriaId,
                            categorias.categoria as categoriaNome,
                            categorias.slug as categoriaSlug
                            FROM categorias
                            WHERE categorias.id = :id
                            "); 
        $this->db->bind(":id", $id);
        return $this->db->resultado();
    }

    public function listarCategoriaPorSlug($slug){
        $this->db->query("SELECT *,
                            categorias.id as categoriaId,
                            categorias.categoria as categoriaNome,
                            categorias.slug as categoriaSlug
                            FROM categorias
                            WHERE categorias.slug = :slug
                            "); 
        $this->db->bind(":slug", $slug);
        return $this->db->resultado();
    }

}