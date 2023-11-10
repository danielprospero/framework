<?php

error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);

function phpErro($erro, $mensagem, $arquivo, $linha) {

    switch($erro):
        case E_ERROR || 2:
            $tipo = 'E_WARNING';
            $css = 'alert-warning';
            break;
        case E_NOTICE || 8:
            $tipo = 'E_NOTICE';
            $css = 'alert-warning';
            break;
        case E_USER_ERROR || 256:
            $tipo = 'E_USER_ERROR';
            $css = 'alert-danger';
            break;
        case E_USER_WARNING || 512:
            $tipo = 'E_USER_WARNING';
            $css = 'alert-warning';
            break;
        case E_USER_NOTICE || 1024:
            $tipo = 'E_USER_NOTICE';
            $css = 'alert-warning';
            break;
        case E_STRICT  || 2048:
            $tipo = 'E_STRICT';
            $css = 'alert-warning';
            break;
        case E_RECOVERABLE_ERROR || 4096:
            $tipo = 'E_RECOVERABLE_ERROR';
            $css = 'alert-warning';
            break;
        case E_DEPRECATED || 8192:
            $tipo = 'E_DEPRECATED';
            $css = 'alert-warning';
            break;
        case E_USER_DEPRECATED || 16384:
            $tipo = 'E_USER_DEPRECATED';
            $css = 'alert-warning';
            break;
        default:
            $tipo = 'Desconhecido';
            $css = 'alert-warning';
            break;
    endswitch;


    echo "<p class=\"alert {$css}\"><b>Erro:</b> {$mensagem} <b>no arquivo:</b> {$arquivo} <b>na linha: </b><stong class=\"text-danger\">{$linha}</strong></p>";
    $logs = date('d-m-Y H:i:s') . " - {$tipo} - {$mensagem} - {$arquivo} - {$linha}" . PHP_EOL;
    error_log($logs,3,"".dirname(__FILE__)."/logs/phperror.log");

    die();
}

set_error_handler("phpErro");