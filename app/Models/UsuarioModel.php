<?php

class UsuarioModel {
    
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function checarEmail($email){
        $this->db->query("SELECT email FROM usuarios WHERE email = :email");
        $this->db->bind(":email", $email);

        if($this->db->resultado()){
            return true;
        } else {
            return false;
        }
    }

    public function armazenar($dados){
        
        $this->db->query("INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)");
        $this->db->bind(":nome", $dados['nome']);
        $this->db->bind(":email", $dados['email']);
        $this->db->bind(":senha", $dados['senha']);

        if($this->db->executa()){
            return true;
        } else {
            return false;
        }
    }

    public function checarLogin($email, $senha){
        $this->db->query("SELECT * FROM usuarios WHERE email = :email");
        $this->db->bind(":email", $email);

        if($this->db->resultado()){

            $resultado = $this->db->resultado();
            if(password_verify($senha, $resultado->senha)){
                return $resultado;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function listarUsuarios(){
        $this->db->query("SELECT *,
                            usuarios.id as usuarioId,
                            usuarios.nome as usuarioNome,
                            usuarios.email as usuarioEmail,
                            usuarios.imagem as usuarioImagem,
                            usuarios.status_id as usuarioStatusId,
                            usuarios.acesso_id as usuarioAcessoId,
                            usuarios.criado_em as usuarioDataCadastro,
                            usuarios.modificado_em as usuarioDataModificado,
                            status_usuarios.nome as statusNome,
                            acessos.nome as acessoNome
                            FROM usuarios
                            INNER JOIN status_usuarios ON usuarios.status_id = status_usuarios.id
                            INNER JOIN acessos ON usuarios.acesso_id = acessos.id
                            ");
        return $this->db->resultados();
    } 

    public function listarUsuarioPorId($id){
        $this->db->query("SELECT * FROM usuarios WHERE id = :id");
        $this->db->bind(":id", $id);
        return $this->db->resultado();
    }
    
    public function seo($id){
        $this->db->query("SELECT * FROM usuarios WHERE id = :id");
        $this->db->bind(":id", $id);
        return $this->db->resultado();
    }

    public function listarAdmin(){
        $this->db->query("SELECT *
                            FROM usuarios
                            WHERE usuarios.acesso_id = 1
                            ");
        return $this->db->resultado();
    }


}