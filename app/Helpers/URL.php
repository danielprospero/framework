<?php

class URL {

    public static function redirecionar($pagina){
        header('location: ' . URL . '/' . $pagina);
    }

}