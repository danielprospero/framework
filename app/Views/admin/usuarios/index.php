

<h4>Usuários 
        <a href="<?=URL?>/admin/cadastrar/usuario">
            <button class="btn btn-primary">Adicionar novo</button>
        </a>
    </h4>

    <div class="table-responsive">
        <table class="table">
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Imagem</th>
                <th>Status</th>
                <th>Acesso</th>
                <th>Criado em</th>
                <th>Modificado em</th>
                <th>Ações</th>
            </tr>

            <?php if(!empty($dados['usuarios'])): ?>
                <?php foreach($dados['usuarios'] as $usuario): ?>
                    <tr>
                        <td><?=$usuario->usuarioId?></td>
                        <td><?=$usuario->usuarioNome?></td>
                        <td><?=$usuario->usuarioEmail?></td>
                        <td>
                            <?php if($usuario->usuarioImagem != null): ?>
                                <img src="<?=URL?>/<?=$usuario->usuarioImagem?>" alt="Foto Perfil" style="width: 100px; heigth: 100px; object-fit: cover;">
                            <?php else: ?>
                                <img src="<?=URL?>/public/img/avatar-profile.png" alt="Foto Perfil" style="width: 100px; heigth: 100px; object-fit: cover;">
                            <?php endif; ?>
                        </td>
                        <td><?=$usuario->statusNome?></td>
                        <td><?=$usuario->acessoNome?></td>
                        <td><?=Checa::dataBr($usuario->usuarioDataCadastro)?></td>
                        <td><?php if(Checa::dataBr($usuario->usuarioDataModificado) != null){ echo Checa::dataBr($usuario->usuarioDataModificado); }else{ echo 'Não modificado'; } ?></td>
                        <td>
                            <a href="<?=URL?>/admin/editar/usuario<?=$usuario->usuarioId?>">
                                <button class="btn btn-warning text-white btn-sm"><i class="bi bi-pencil-square"></i></button>
                            </a>
                            <a href="<?=URL?>/admin/deletar/usuario<?=$usuario->id?>">
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
