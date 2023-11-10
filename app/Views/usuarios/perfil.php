<div class="container my-3">
    <div class="card text-bg-tertiary border-3">
        <?= Sessao::mensagem('usuario') ?>
        <div class="row">
            <div class="col-md-4">
                <div class="card m-3">
                    <div class="my-2">
                        <label class="d-block">
                            <img class="mx-auto d-block image-preview-edit" src="<?= URL ?>/public/<?= $dados['imagem'] ?>" style="cursor: pointer;width: 150px;height: 150px;object-fit: cover;">
                            <input onchange="display_image_edit(this.files[0])" type="file" name="imagem" class="d-none">
                        </label>
                        <?php if(!empty($dados['imagem_erro'])):?>
                            <div class="text-danger"><?=$dados['imagem_erro']?></div>
                        <div class="text-danger"><?=$dados['imagem_erro']?></div>
                        <?php endif;?>

                        <script>
                            
                            function display_image_edit(file)
                            {
                                document.querySelector(".image-preview-edit").src = URL.createObjectURL(file);
                            }
                        </script>
                    </div>
                    <div class="card-header bg-body-dark border-3 pt-3 text-center align-items-center">
                        <h5 class="card-title text-center"><?= $dados['nome'] ?></h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><?= $dados['biografia'] ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card m-3">
                    <div class="card-header bg-body-tertiary rounded-3">
                        Dados Pessoais
                    </div>
                    <div class="card-body">

                        <form name="atualizar" method="POST" action="<?= URL ?>/usuarios/perfil/<?= $dados['id'] ?>">
                            <div class="form-floating">
                                <input value="<?= $dados['nome'];?>" name="nome" type="text" class="form-control mb-2" id="floatingInput" placeholder="Nome" <?= $dados['nome_erro'] ? 'is-invalid' : '' ?>>
                                <label for="floatingInput">Nome de usuário</label>
                                <div class="invalid-feedback">
                                    <?= $dados['nome_erro'] ?>
                                </div>
                            </div>
                            <div class="form-floating">
                                <input value="<?= $dados['email'];?>" name="email" type="email" class="form-control mb-2" id="floatingInput" placeholder="Email" <?= $dados['email_erro'] ? 'is-invalid' : '' ?>>
                                <label for="floatingInput">Email</label>
                                <div class="invalid-feedback">
                                    <?= $dados['email_erro'] ?>
                                </div>
                            </div>
                        

                            <div class="form-floating">
                                <input type="password" name="senha" id="floatingInput" class="form-control mb-2" placeholder="senha" <?= $dados['senha_erro'] ? 'is-invalid' : '' ?>>
                                <label for="floatingInput">Senha</label>
                                <div class="invalid-feedback">
                                    <?= $dados['senha_erro'] ?>
                                </div>
                            </div>

                            <div class="form-floating">
                                <textarea name="biografia" id="floatingInput" class="form-control" rows="15" placeholder="biografia"><?= $dados['biografia'] ?></textarea>
                                <label for="floatingInput">Biografia</label>
                            </div>

                            <input type="submit" value="Atualizar" data-toggle="tooltip" title="Atualizar Dados do Perfil" class="btn btn-primary mt-3">

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>