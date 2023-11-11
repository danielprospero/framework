 <h4>Categorias 
        <a href="<?=URL?>/admin/cadastrar/categoria">
            <button class="btn btn-primary">Adicionar nova</button>
        </a>
    </h4>

    <div class="table-responsive">
        <table class="table">
            <tr>
                <th>#</th>
                <th>Categoria</th>
                <th>Slug</th>
                <th>Status</th>
                <th>Criado</th>
                <th>Modificado</th>
                <th>Ações</th>
            </tr>

            <?php if(!empty($dados['categorias'])): ?>
                <?php foreach($dados['categorias'] as $categoria): ?>
                    <tr>
                        <td><?=$categoria->categoriaId?></td>
                        <td><?=$categoria->categoriaNome?></td>
                        <td><?=$categoria->categoriaSlug?></td>
                        <td><?=$categoria->statusCategoriaNome?></td>
                        <td><?=Checa::dataBr($categoria->categoriaCriado)?></td>
                        <td><?php if(Checa::dataBr($categoria->categoriaModificado) != null) {echo Checa::dataBr($categoria->categoriaModificado);} else {echo "Não modificado";}?></td>
                        <td>
                            <a href="<?=URL?>/admin/editar/categoria<?=$categoria->categoriaId?>">
                                <button class="btn btn-warning text-white btn-sm"><i class="bi bi-pencil-square"></i></button>
                            </a>
                            <a href="<?=URL?>/admin/deletar/categoria<?=$categoria->categoriaId?>">
                                <button class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></button>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </div>