<?php

class Sessao {

    public static function mensagem($nome, $texto = null, $class = null){

        if(!empty($nome)){

            if(!empty($texto) && empty($_SESSION[$nome])){

                $_SESSION[$nome] = $texto;
                $_SESSION[$nome . 'classe'] = $class;

            } elseif(empty($texto) && !empty($_SESSION[$nome])){

                $class = !empty($_SESSION[$nome . 'classe']) ? $_SESSION[$nome . 'classe'] : 'alert alert-success';
                echo '<div class="' . $class . '" id="msg-flash">' . $_SESSION[$nome] . '</div>';
                unset($_SESSION[$nome]);
                unset($_SESSION[$nome . 'classe']);

            }
        }
    }

    public static function estaLogado(){
        if(isset($_SESSION['usuario_id'])){
            return true;
        } else {
            return false;
        }
    }
}