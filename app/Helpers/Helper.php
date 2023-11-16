<?php

class Helper {

    public static function dataBr($data){
        $data = date('d/m/Y H:i', strtotime($data));
        return $data;
    }

    public static function resumirTexto($texto, $limite, $continue = null) {
        $contador = strip_tags(trim($texto));
        $limite = (int) $limite;
    
        $array = explode(' ', $contador);
        $totalPalavras = count($array);
        $textoResumido = implode(' ', array_splice($array, 0, $limite));
    
        $continue = (empty($continue) ? '...' : ' ' . $continue);
        $resultado = ($limite < $totalPalavras ? $textoResumido . $continue : $textoResumido);
    
        // Adiciona uma classe para identificar que este texto pode ser expandido
        return '<span class="expandir-texto" data-fulltext="' . htmlspecialchars($texto) . '">' . $resultado . '</span>';
    }
}