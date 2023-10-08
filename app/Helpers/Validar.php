<?php

class Validar {

    public static function verificaNome($nome){
        if(!preg_match('/^[a-zA-Z ]*$/',$nome)){
            return true;
        }else{
            return false;
        }
    }
    public static function verificaEmail($email){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        }else{
            return false;
        }

    }

}