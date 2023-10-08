<?php 

class URL {

    public static function redirecionar($url){
        header('location: ' . URL . '/' . $url);
    }

}