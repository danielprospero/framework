<main class="form-signin w-100 m-auto">

    <form nome="login" action="<?=URL?>/usuario/login" method="post" class="w-100">

        <h1 class="h3 m-5 mb-5 fw-normal">Login</h1>

        <?= Sessao::mensagem('email_erro')?>

        <?= Sessao::mensagem('senha_email_erro')?>

        <div class="form-floating">
            <input value="" name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Email</label>
        </div>

       <?php Sessao::mensagem('senha_erro')?>

        <div class="form-floating mb-3">
            <input value="" name="senha" type="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Senha</label>
        </div>

        <div class="my-2">Não tem uma conta? <a href="<?=URL?>/usuario/cadastrar">Cadastre-se</a></div>
        
        <div class="form-check text-start my-3">
            <input name="remember" class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
            <label class="form-check-label mb-3" for="flexCheckDefault">
                Lembra-me
            </label>
        </div>

        <button class="btn mb-5 btn-primary w-100 py-2" type="submit">Entrar</button>

    </form>

</main>