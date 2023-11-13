<?php

class URL {

    public static function redirecionar($pagina){
        header('location: ' . URL . '/' . $pagina);
    }

    public static function urlAmigavel($titulo){

        $mapa = [];
        $mapa['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
        $mapa['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                 ';

        $url = strtr(utf8_decode($titulo), utf8_decode($mapa['a']), $mapa['b']);
        $url = strip_tags(trim($url));
        $url = str_replace(' ', '-', $url);
        $url = str_replace(array('-----', '----', '---', '--'), '-', $url);


        return strtolower(utf8_encode($url));
    }
}