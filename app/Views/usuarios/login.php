<div class="col-xl-4 col-md-6 mx-auto p-5">
<?=Sessao::mensagem('usuario')?>
    <form nome="login" method="POST">
        <a href="home">
            <img class="mb-4" src="<?=URL?>/public/img/earth-483978_640.png" alt="" width="40" style="object-fit: cover;">
        </a>
        <h1 class="h3 mb-3 fw-normal">Login</h1>

        <div class="form-floating">
        <input value="<?=$dados['email']?>" name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
        <label for="floatingInput">Email</label>
        </div>

        <?php if (!empty($dados['email_erro'])):?>
            <div class="alert alert-danger"><?=$dados['email_erro']?></div>
        <?php endif;?>

        <div class="form-floating">
        <input value="<?=$dados['senha']?>" name="senha" type="password" class="form-control" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Senha</label>
        </div>

        <?php if (!empty($dados['senha_erro'])):?>
            <div class="alert alert-danger"><?=$dados['senha_erro']?></div>
        <?php endif;?>

        <div class="my-2">Não tem uma conta? <a href="<?=URL?>/usuarios/cadastrar">Cadastre-se</a></div>
        <div class="form-check text-start my-3">
        <input name="remember" class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault">
            Lembra-me
        </label>
        </div>
        <button class="btn btn-primary w-100 py-2" type="submit">Entrar</button>

    </form>
</div>