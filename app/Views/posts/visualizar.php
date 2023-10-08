<div class="container my-5">
    <nav area-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= URL ?>/posts">Posts</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $dados['post']->titulo ?></li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header">
            <h2><?= $dados['post']->titulo ?></h2>
        </div>
        <div class="card-body">
            <p class="card-text"><?= $dados['post']->texto ?></p>
            <p class="card-text">Criado por: <?= $dados['usuario']->nome ?> em <?= Data::formataData($dados['post']->postDataCadastro) ?></p>
            <?php if ($dados['post']->usuarioId == $_SESSION['usuario_id']) : ?>
                <div class="card-body d-flex justify-content-between">
                     <form action="<?= URL . '/posts/editar/' . $dados['post']->postId ?>" method="POST">
                            <input type="submit" class="btn btn-sm btn-primary" value="Editar">
                    </form>
                    <form action="<?= URL . '/posts/deletar/' . $dados['post']->postId ?>" method="POST">
                            <input type="submit" class="btn btn-sm btn-danger" value="Deletar" onclick="return confirmarExclusao();">
                    </form>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>

