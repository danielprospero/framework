<?php include_once (APP . '/Views/topo.php'); ?>

<div class="section mt-5" id="our-classes">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="mt-3 mb-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-chevron p-3 bg-body-tertiary rounded-3">
                                <li class="breadcrumb-item">
                                    <a class="link-body-emphasis" href="<?=URL?>">
                                        <i class="bi bi-house-door-fill"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a class="link-body-emphasis fw-semibold text-decoration-none" href="<?=URL?>/posts">Posts</a>
                                </li>
                                <li class='breadcrumb-item active' aria-current='page'><?=$dados['post']->postTitulo?></li>
                            </ol>
                        </nav>
                    </div>
                    <div class='tabs-content'>
                        <?php if(!empty($dados['post'])): ?>
                            <div class="g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                                <h1 class="mt-4 mx-4"><?=$dados['post']->postTitulo?></h1>
                                <p class="mx-4">
                                <img src="<?=URL?>/<?=$dados['post']->usuarioImagem?>" alt="" width="20" height="20" class="rounded-circle"> </i> <?=$dados['post']->usuarioNome?> &nbsp;|&nbsp; 
                                    <i class="bi bi-calendar3"></i> <?=Checa::dataBr($dados['post']->postDataCadastro)?> &nbsp;|&nbsp;
                                    <i class="bi bi-tags-fill"></i> <?=$dados['categoria']->categoriaNome?> &nbsp;|&nbsp;
                                    <i class="bi bi-eye-fill"> <?=$dados['post']->postVisitas?> visitas</i>
                                </p>
                                <div class="col-12 d-lg-block img-fluid">
                                    <img class="bd-placeholder-img w-100 p-4" width="100%" style="object-fit:cover;" src="<?=URL?>/<?=$dados['post']->postImagem?>" alt="Thumbnail">
                                </div>
                                <div class="col p-4 d-flex flex-column position-static">
                                    <p class="card-text mb-auto"><?=$dados['post']->postConteudo?></p>
                                </div>

                                <?php if(!empty($dados['post']->usuarioId) == !empty($_SESSION['usuario_id'])): ?>
       
                                    <div class="d-flex justify-content-between align-items-center p-4">
                                        <a href="<?=URL?>/post/editar/<?=$dados['post']->postSlug?>" class="btn btn-primary">Editar</a>
                                        <form action="<?=URL?>/post/deletar/<?=$dados['post']->postSlug?>" method="post">
                                            <input type="submit" class="btn btn-danger" value="Deletar">
                                        </form>
                                    </div>
                                <?php endif ?>
                            </div>

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
                            <p class="mb-0"><?=$dados['seo']->biografia?></p>'   
                        </div>
                        <div>
                            <h4 class="fst-italic">Postagens recentes</h4>
                            <ul class="list-unstyled">
                                <li>
                                <?php if(!empty($dados['postsrecentes'])): ?>
                                    <?php foreach($dados['postsrecentes'] as $post): ?>
                                        <a class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 link-body-emphasis text-decoration-none border-top" href="<?=URL?>/posts/<?=$post->postSlug?>">
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
</div>

<?php include_once APP . '/Views/rodape.php';
