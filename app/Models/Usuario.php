<?php

class Usuario {
    private $db;

    public function __construct() {
        $this->db = new Conexao();
    }

    public function armazenar($dados) {
        $this->db->query("INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)");
        $this->db->bind(":nome", $dados['nome']);
        $this->db->bind(":email", $dados['email']);
        $this->db->bind(":senha", $dados['senha']);
        if ($this->db->executa()) {
            return true;
        } else {
            return false;
        }
    }

    public function verificarEmailExiste($email){
        $this->db->query("SELECT email FROM usuarios WHERE email = :email");
        $this->db->bind(":email", $email);
        if($this->db->resultado()){
            return true;
        }else{
            return false;
        }
    }

    public function verificarLogin($email, $senha){
        $this->db->query("SELECT * FROM usuarios WHERE email = :email");
        $this->db->bind(":email", $email);
        $resultado = $this->db->resultado();
        if($resultado){
            if(password_verify($senha, $resultado->senha)){
                return $resultado;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function lerUsuarioPorId($id){
        $this->db->query("SELECT * FROM usuarios WHERE id = :id");
        $this->db->bind(":id", $id);
        return $this->db->resultado();
    }


}