<?php include_once (APP . '/Views/topo.php'); ?>

<div class="section mt-5" id="our-classes">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class='tabs-content'>
                        <?php if($dados['posts']):?>
                            <?php foreach($dados['posts'] as $post): ?>

                                <article class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                                    <a href="<?=URL?>/<?=$post->postSlug?>">
                                        <img src="<?=URL?>/<?=$post->postImagem?>" class="img-fluid" alt="">
                                    </a>
                                    
                                    <a href="<?=URL?>/<?=$post->postSlug?>" class="text-decoration-none text-dark">
                                        <h4 class="mb-2 mt-2 mx-2"><?=$post->postTitulo?></h4>
                                    </a>
                                    <p class="mx-2">
                                        <img src="<?=URL?>/<?=$post->usuarioImagem?>" alt="" width="20" height="20" class="rounded-circle">
                                        <?=$post->usuarioNome?> &nbsp;|&nbsp;
                                        <i class="bi bi-calendar3"></i> <?=Checa::dataBr($post->postDataCadastro)?> &nbsp;|&nbsp;
                                        <i class="bi bi-tags-fill"></i> <?=$post->categoriaNome?> &nbsp;|&nbsp;
                                        <i class="bi bi-eye-fill"> <?=$post->postVisitas?> visitas</i>
                                    </p>
                                    <p class="card-text mb-auto mx-2"><?=$post->postDescricao?></p>
                                    <div class="main-button">
                                        <a href="<?= URL . '/post/' . $post->postSlug?>" class="icon-link gap-1 icon-link-hover stretched-link m-2">
                                            continue lendo
                                            <i class="bi bi-chevron-right"></i>
                                        </a>
                                    </div>
                                    <?php if($post->usuario_id == isset($_SESSION['usuario_id'])): ?>
                                        <div class="d-flex justify-content-between align-items-center p-4">
                                            <a href="<?=URL?>/post/editar/<?=$post->postSlug?>" class="btn btn-primary">Editar</a>
                                            <a href="<?=URL?>/post/deletar/<?=$post->postSlug?>" class="btn btn-danger">Deletar</a>
                                        </div>
                                    <?php endif ?>
                                </article>
                            <?php endforeach ?>
                        <?php else: ?>
                            <div class="alert alert-warning" role="alert">
                                Nenhuma postagem encontrada!
                            </div>
                        <?php endif ?>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="position-sticky" style="top: 2rem;">
                        <div class="p-4 mb-3 bg-body-tertiary rounded text-center">
                                <img src="<?=URL?>/public/img/daniel-sorrindo.jpeg" class="img-fluid rounded-circle" style="width: 200px; height: 200px; object-fit: cover;" alt="...">
                            <h4 class="fst-italic mt-3"><?=$dados['seo']->nome?></h4>
                            <p class="mb-0"><?=$dados['seo']->biografia?></p>
                        </div>
                        <div>
                            <h4 class="fst-italic">Postagens recentes</h4>
                            <ul class="list-unstyled">
                                <li>
                                <?php if(!empty($dados['postsrecentes'])): ?>
                                    <?php foreach($dados['postsrecentes'] as $post): ?>
                                        <a class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 link-body-emphasis text-decoration-none border-top" href="<?=URL?>/post/<?=$post->postSlug?>">
                                            <img src="<?=URL?>/<?=$post->postImagem?>" class="img-fluid" width="100" height="96" alt="" >
                                            <div class="col-lg-8">
                                                <h6 class="mb-0"><?=$post->postTitulo?></h6>
                                                <i class="bi bi-calendar3"></i> <small class="text-body-secondary"><?=Checa::dataBr($post->postDataCadastro)?></small>
                                            </div>
                                        </a>
                                    <?php endforeach ?>
                                <?php else: ?>
                                    <div class="alert alert-warning" role="alert">
                                            Nenhuma postagem encontrada!
                                    </div>
                                <?php endif ?>
                                </li>
                            </ul>
                        </div>

                        <div class="p-4 bg-body-tertiary rounded border">
                            <h2 class="fst-italic">Categorias</h2>
                            <ol class="list-unstyled mb-0">
                                <div class="p-2">
                                <?php foreach($dados['categorias'] as $categoria): ?>
                                    <li class="border-bottom p-2"><a href="<?=URL?>/categoria/<?=$categoria->categoriaSlug?>" class="link-body-primary fw-semibold text-decoration-none"><?=$categoria->categoriaNome?></a></li>
                                <?php endforeach ?>
                                </div>
                            </ol>
                        </div>
                    </div>           
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 mb-4 text-center">
        <a href="<?=$PAGE['first_link']?>">
            <button class="btn btn-primary ">Anterior</button>
        </a>
        <a href="<?=$PAGE['prev_link']?>">
            <button class="btn btn-primary ">1</button> 
        </a>
        <a href="<?=$PAGE['next_link']?>">
            <button class="btn btn-primary ">Próximo</button>
        </a>
    </div>

</div>

<?php include_once APP . '/Views/rodape.php';
