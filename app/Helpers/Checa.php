<?php

class Checa {

    public static function checarNome($nome){
        if(!preg_match("/^[áÁàÀãÃâÂéÉêÊíÍóÓôÔõÕúÚçÇa-zA-Z\s]+$/", $nome)){
            return true;
        } else {
            return false;
        }
    }

    public static function checarEmail($email){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        } else {
            return false;
        }
    }

    public static function dataBr($data){
        if(isset($data)){
            return date('d/m/Y H:i', strtotime($data));
        } else {
            return false;
        }
    }

    public static function pegarImagem($imagem){
        $imagem = $imagem ?? '';

        if(file_exists($imagem)){
            return URL . '/' . $imagem;
        } 
            
        return URL . '/public/img/sem-foto.jpg';
    }

    public static function checarImagem($imagem){
        $extensoes = ['jpg', 'jpeg', 'png', 'gif'];
        $extensao = explode('.', $imagem['name']);
        $extensao = end($extensao);

        if(!in_array($extensao, $extensoes)){
            return true;
        } else {
            return false;
        }
    }

}