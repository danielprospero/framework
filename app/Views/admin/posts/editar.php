<div class="col-md-6 mx-auto">

    <div class="mt-3 mb-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-chevron p-3 bg-body-tertiary rounded-3">
                <li class="breadcrumb-item">
                    <a class="link-body-emphasis" href="<?=URL?>">
                        <i class="bi bi-house-door-fill"></i>
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a class="link-body-emphasis fw-semibold text-decoration-none" href="<?=URL?>/posts"></a>
                    Posts
                </li>
            </ol>
        </nav>
    </div>

    <form nome="editar" enctype="multipart/form-data" action="<?=URL?>admin/editar/post<?=$dados['slug']?>" method="post" class="w-100">

        <h1 class="h3 mb-3 mt-3 fw-normal">Editar Post</h1>

        <div class="my-2">
	    	<label class="d-block">
	    		<img class="mx-auto d-block image-preview-edit" src="<?=URL?>/<?=$dados['imagem']?>" style="cursor: pointer;width: 150px;height: 150px;object-fit: cover;">
	    		<input onchange="display_image_edit(this.files[0])" type="file" name="imagem" class="d-none">
	    	</label>
	    	<?php Sessao::mensagem('imagem_error', 'Selecione uma imagem', 'alert alert-danger'); ?>

	    	<script>
	    		
	    		function display_image_edit(file)
	    		{
	    			document.querySelector(".image-preview-edit").src = URL.createObjectURL(file);
	    		}
	    	</script>
	    </div>
  
        <?php Sessao::mensagem('imagem_error', 'Selecione uma imagem', 'alert alert-danger'); ?>

        <div class="form-floating">
        <input value="<?= $dados['titulo'] ?>" name="titulo" type="text" class="form-control" id="floatingInput" placeholder="Nome do Postagem">
        <label for="floatingInput">Titulo de Postagem </label>
        </div>

        <?php Sessao::mensagem('titulo_error', 'Preencha o campo titulo', 'alert alert-danger'); ?>

        <div class="form-floating">
        <input value="<?= $dados['descricao'] ?>" name="descricao" type="text" class="form-control" id="floatingInput" placeholder="Descrição do Postagem">
        <label for="floatingInput">Descrição de Postagem </label>
        </div>

        <?php Sessao::mensagem('descricao_error', 'Preencha o campo descrição', 'alert alert-danger'); ?>

        <div class="form-floating">
            <textarea id="summernote" rows="8" name="conteudo" id="floatingInput" placeholder="Conteúdo" type="conteudo" class="form-control textarea"><?= $dados['conteudo'] ?></textarea>
        </div>

        <?php Sessao::mensagem('conteudo_error', 'Preencha o campo conteúdo', 'alert alert-danger'); ?>

        <div class="form-floating">
            <input value="<?= $dados['slug'] ?>" name="slug" type="text" class="form-control" id="floatingInput" placeholder="Slug do Post">
            <label for="floatingInput">Slug do Post </label>
        </div>

        <?php Sessao::mensagem('slug_error', 'Preencha o campo slug', 'alert alert-danger'); ?>

        <div class="form-floating">
            <select name="categoria_id" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                <option value="" selected>Selecione uma categoria</option>
                <?php foreach($dados['categorias'] as $categoria): ?>
                    <option <?php if($dados['categoria_id'] == $categoria->categoriaNome) echo 'selected' ?> value="<?=$categoria->categoriaId?>"><?=$categoria->categoriaNome?></option>
                <?php endforeach ?>
            </select>
            <label for="floatingSelect">Categoria</label>
        </div>
        <?php Sessao::mensagem('categoria_id_error', 'Selecione uma categoria', 'alert alert-danger'); ?>
        <div class="mb-4">
            <a href="<?=URL?>/posts" class="text-decoration-none">
                <button class="mt-4 btn btn-primary py-2" type="button">Voltar</button>
            </a>
            <button class="mt-4 btn btn-primary float-end py-2" value="Cadastrar" type="submit">Cadastrar</button>
        </div>
    </form>
  </div>

  <link rel="stylesheet" href="<?=URL?>/public/summernote/summernote-lite.min.css">
    <script src="<?=URL?>/js/jquery.js"></script>
    <link rel="stylesheet" href="<?=URL?>/public/css/edit.css">

    <script src="<?=URL?>/summernote/summernote-lite.min.js"></script>
    <script>
      $('#summernote').summernote({
        placeholder: 'Publicar conteúdo',
        tabsize: 2,
        height: 400
      });
    </script>