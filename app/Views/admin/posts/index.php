<h4>Postagens 
        <a href="<?=URL?>/admin/cadastrar/post">
            <button class="btn btn-primary">Cadastrar novo</button>
        </a>
    </h4>

    <div class="table-responsive">
        <table class="table">
            <tr>
                <th>Id</th>
                <th>Imagem</th>
                <th>Titulo</th>
                <th>URL</th>
                <th>Categoria</th>
                <th>Data</th>
                <th>Modificado</th>
                <th>Ações</th>
            </tr>

            <?php if(!empty($dados['posts'])): ?>
                <?php foreach($dados['posts'] as $post): ?>
                    <tr>
                        <td><?=$post->postId?></td>
                        <td>
                            <img src="<?=URL?>/<?=$post->postImagem?>" alt="Foto Perfil" style="width: 100px; heigth: 100px; object-fit: cover;">
                        </td>                        
                        <td><?=$post->postTitulo?></td>
                        <td><?=$post->postSlug?></td>
                        <td><?=$post->categoriaNome?></td>
                        <td><?=Checa::dataBr($post->postDataCadastro)?></td>
                        <td><?php if(Checa::dataBr($post->postDataModificado) != null){ echo Checa::dataBr($post->postDataModificado); }else{ echo 'Não modificado'; } ?></td>
                        <td>
                            <a href="<?=URL?>/admin/editar/post<?=$row['id']?>">
                                <button class="btn btn-warning text-white btn-sm"><i class="bi bi-pencil-square"></i></button>
                            </a>
                            <a href="<?=URL?>/admin/deletar/post<?=$row['id']?>">
                                <button class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></button>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
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
