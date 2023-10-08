<div class="container my-3">

    <div class="card">
        <?= Sessao::mensagem('usuario') ?>
        <div class="row">
            <div class="col-md-4">
                <div class="card m-3">
                    <div class="card-header bg-secondary">
                        <h5 class="card-text text-center"><?= $dados['nome'] ?></h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><?= $dados['biografia'] ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card m-3">
                    <div class="card-header bg-secondary">
                        Dados Pessoais
                    </div>
                    <div class="card-body">

                        <form name="atualizar" method="POST" action="<?= URL ?>/usuarios/perfil/<?= $dados['id'] ?>">
                             <?php if (!empty($dados['nome_erro']) || !empty($dados['email_erro']) || !empty($dados['senha_erro']) || !empty($dados['confirma_senha_erro']) || !empty($dados['termos_erro'])):?>
                                <div class="alert alert-danger">Por favor, corrija os erros abaixo</div>
                            <?php endif;?>

                            <div class="form-floating">
                                <input value="<?=$dados['nome']?>" name="nome" type="text" class="form-control" id="floatingInput" placeholder="Nome do usuário">
                                <label for="floatingInput">Nome de usuário </label>
                            </div>

                            <?php if (!empty($dados['nome_erro'])):?>
                                <div class="alert alert-danger"><?=$dados['nome_erro']?></div>
                            <?php endif;?>

                            <div class="form-floating">
                                <input value="<?=$dados['email']?>" name="email" type="email" class="form-control mb-0 rounded-2" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Email</label>
                            </div>

                            <?php if (!empty($dados['email_erro'])):?>
                                <div class="alert alert-danger"><?=$dados['email_erro']?></div>
                            <?php endif;?>

                            <div class="form-floating">
                                <input name="senha" type="password" class="form-control rounded-3" id="floatingPassword" placeholder="Senha">
                                <label for="floatingPassword">Senha</label>
                            </div>

                            <?php if (!empty($dados['senha_erro'])):?>
                                <div class="alert alert-danger"><?=$dados['senha_erro']?></div>
                            <?php endif;?>

                            <div class="form-floating">
                                <input name="confirma_senha" type="password" class="form-control rounded-3" id="floatingPassword" placeholder="Confirmar Senha">
                                <label for="floatingPassword">Confirmar Senha</label>
                            </div>

                            <?php if (!empty($dados['confirma_senha_erro'])):?>
                                <div class="alert alert-danger"><?=$dados['confirma_senha_erro']?></div>
                            <?php endif;?>
    

                            <div class="form-outline">
                                <textarea name="biografia" id="biografia" class="form-control"  placeholder="Biografia"  rows="5"><?=$dados['biografia']?></textarea>
                            </div>

                            <!-- <input type="submit" value="Atualizar" data-toggle="tooltip" title="Atualizar Dados do Perfil" class="btn btn-primary"> -->
                            <button class="btn btn-primary w-100 py-2 mt-4" value="Atualizar" type="submit">Atualizar</button>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>