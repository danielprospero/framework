<div class="container">
<div class="p-2">
    <h1 Class="mx-4">Destaques</h1>
    <div class="row my-2 justify-content-center">

        <?php if($dados['posts']):?>

            <?php foreach($dados['posts'] as $post ):?>
                <div class="col-md-12 col-lg-6">
                    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-static">
                            <strong class="d-inline-block mb-2 text-primary-emphasis"><?=$post->categoriaNome?></strong>

                            <a href="<?=URL?>/post/<?=$post->postSlug?>" class="text-decoration-none">
                                <h5 class="mb-0"><?=$post->postTitulo?></h5>
                            </a>
                            <div class="mb-1 text-body-secondary"><img src="<?=URL?>/<?=$post->usuarioImagem?>" alt="Imagem do post" width="20" height="20" class="rounded-circle"> <?=$post->usuarioNome?></div>
                            <div class="mb-1 text-body-secondary"><i class="bi bi-calendar3"></i> <?=Checa::dataBr($post->postDataCadastro)?></div>

                                <p class="card-text mb-auto"><?=$post->postDescricao?></p>
                                <a href="<?=URL?>/post/<?=$post->postSlug?>" class="icon-link gap-1 icon-link-hover stretched-link m-2">
                                    continue lendo
                                    <svg class="bi"><use xlink:href="#chevron-right"/></svg>
                                </a>
                            </div>
                            <div class="col-lg-5 col-12 d-lg-block align-self-center">
                                <a href="<?=URL?>/post/<?=$post->postSlug?>">
                                    <img style="object-fit:cover;" src="<?=URL?>/<?=$post->postImagem?>" alt="Thumbnail" class="bd-placeholder-img w-100" width="300" height="250">
                                </a>
                            </div>
                        </div>
                    </div>

                

            <?php endforeach ?>
        <?php else: ?>
            <div class="alert alert-warning" role="alert">
                Nenhuma postagem encontrada!
            </div>
        <?php endif ?>

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