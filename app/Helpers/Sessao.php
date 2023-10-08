<?php 

class Sessao {
    public static function mensagem($nome, $mensagem = null, $classe = null){
        if(!empty($nome)){
            if(!empty($mensagem) && empty($_SESSION[$nome])){
                if(!empty($_SESSION[$nome])){
                    unset($_SESSION[$nome]);
                }
                $_SESSION[$nome] = $mensagem;
                $_SESSION[$nome.'_classe'] = $classe;
            }elseif(!empty($_SESSION[$nome]) && empty($mensagem)){
                $classe = !empty($_SESSION[$nome.'_classe']) ? $_SESSION[$nome.'_classe'] : 'alert alert-success';
                echo '<div class="'.$classe.'" id="msg-flash">'.$_SESSION[$nome].'</div>';
                unset($_SESSION[$nome]);
                unset($_SESSION[$nome.'_classe']);
            }
        }
    }

    public static function estaLogado(){
        if(isset($_SESSION['usuario_id'])){
            return true;
        }else{
            return false;
        }
    }
}