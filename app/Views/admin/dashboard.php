<?php

$totaladmins = 0;
$totalusuarios = 0;

?>

<h4>Estatísticas</h4>

<div class="row justify-content-center">
    <div class="m-1 col-md-3 bg-link-secondary rounded shadow border">
        <h1><i class="bi bi-person-video3"></i></h1>
        <div>
            Admins
        </div>
        <?php foreach($dados['usuarios'] as $usuario): ?>
            <?php if($usuario->acessoNome == 'Administrador'): ?>
                <?php $totaladmins++; ?>
            <?php endif; ?>
        <?php endforeach; ?>
        <h1><?php if($totaladmins > 0){echo $totaladmins;}else{echo "0";}?></h1>

    </div>
    <div class="m-1 col-md-3 bg-link-secondary rounded shadow border">
        <h1><i class="bi bi-person-circle"></i></h1>
        <div>
            Usuários
        </div>
        <?php foreach($dados['usuarios'] as $usuario): ?>
            <?php if($usuario->acessoNome == 'Usuário'): ?>
                <?php $totalusuarios++; ?>
            <?php endif; ?>
        <?php endforeach; ?>
        <h1><?php if($totalusuarios > 0){echo $totalusuarios;}else{echo "0";}?></h1>

    </div>
    <div class="m-1 col-md-3 bg-link-secondary rounded shadow border">
        <h1><i class="bi bi-file-post"></i></h1>
        <div>
            Postagens
        </div>
        <?php $totalpost = sizeof($dados['posts']); ?>
        <h1><?php if($totalpost > 0){echo $totalpost;}else{echo "0";}?></h1>
    </div>
    <div class="m-1 col-md-3 bg-link-secondary rounded shadow border">
        <h1><i class="bi bi-tags-fill"></i></h1>
        <div>
            Categorias
        </div>
        <?php $totalcat = sizeof($dados['categorias']); ?>
        <h1><?php if($totalcat > 0){echo $totalcat;}else{echo "0";}?></h1>
    </div>
</div>

