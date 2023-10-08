<!-- <script>
    function confirmarExclusao() {
        return confirm("Você tem certeza que deseja deletar este post?");
    }
</script> -->

<div class="container py-5">
    <?= Sessao::mensagem('post') ?>
    <div class="card">
        <div class="card-header text-white d-flex justify-content-between align-items-center">
            <div class="float-right">
                <h2>Postagem</h2>
            </div>
            <div class="float-right">
                <a href="<?=URL?>/posts/cadastrar" class="btn btn-primary">Nova Postagem</a>
            </div>
        </div>
        <div class="card-body">
            <?php foreach ($dados['posts'] as $post) : ?>
                <div class="card mb-2">
                    <div class="card-header">
                        <?= $post->titulo ?>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><?= $post->texto ?></p>
                        <div class="card-body d-flex justify-content-end">
                            <a href="<?= URL ?>/posts/visualizar/<?= $post->postId ?>" class="btn btn-outline-primary float-right">Ler mais</a> 
                        </div>
                        <p class="card-text">Criado por: <?= $post->nome ?> em <?= Data::formataData($post->postDataCadastro) ?></p>
                        <?php if ($post->usuarioId == $_SESSION['usuario_id']) : ?>
                            <div class="card-body d-flex justify-content-between">
                                <a href="<?= URL ?>/posts/editar/<?= $post->postId ?>" class="btn btn-primary">Editar</a>
                                <a href="<?= URL ?>/posts/deletar/<?= $post->postId ?>" class="btn btn-danger float-right" onclick="return confirmarExclusao();">Deletar</a>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>