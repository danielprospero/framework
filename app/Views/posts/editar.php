<div class="col-xl-6 col-md-6 mx-auto p-5">
    <form nome="editar" method="POST">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= URL ?>/posts">Posts</a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar</li>
            </ol>
        </nav>
        <h1 class="h3 mb-3 fw-normal">Editar Post</h1>

        <div class="form-floating">
            <input value="<?=$dados['titulo']?>" name="titulo" type="text" class="form-control" id="floatingInput" placeholder="">
            <label for="floatingInput">Titulo</label>
        </div>

        <?php if (!empty($dados['titulo_erro'])):?>
            <div class="alert alert-danger"><?=$dados['titulo_erro']?></div>
        <?php endif;?>

        <div class="form-outline">
        <textarea name="texto" class="form-control mt-2" id="texto" placeholder="Texto" rows="10"><?=$dados['texto']?></textarea>
        </div>

        <?php if (!empty($dados['texto_erro'])):?>
            <div class="alert alert-danger"><?=$dados['texto_erro']?></div>
        <?php endif;?>

        <button class="btn btn-primary w-100 py-2 mt-4" value="Atualizar Post" type="submit">Editar</button>

    </form>
</div>