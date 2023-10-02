<?php

include_once '../app/configuracao.php';
include_once '../app/Libraries/Rota.php';
include_once '../app/Libraries/Controller.php';

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NOME ?></title>
    <link rel="stylesheet" href="<?= URL ?>public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= URL ?>public/bootstrap/icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= URL ?>public/css/estilo.css">

</head>
<body>

<h1 class="contente_body">Teste</h1>

    <?php
        
       $rota = new Rota();
       echo URL . 'public/bootstrap/css/bootstrap.min.css';

    ?>

    <script src="<?= URL ?>public/bootstrap/js/jquery.js"></script>
    <script src="<?= URL ?>public/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= URL ?>public/js/funcoes.js"></script>

</body>
</html>