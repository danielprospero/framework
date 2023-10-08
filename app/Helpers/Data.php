<?php

class Data {
    public static function formataData($data){
     return date('d/m/Y H:i', strtotime($data));
    }
}