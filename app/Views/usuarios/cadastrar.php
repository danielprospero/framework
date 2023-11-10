<main class="container form-signin w-100 m-auto">
  <form nome="cadastrar" action="<?=URL?>/usuarios/cadastrar" method="post" class="w-100">

    <h1 class="h3 m-5 fw-normal">Cadastrar Usuário</h1>

    <?php if (!empty($dados['nome_erro']) || !empty($dados['email_erro']) || !empty($dados['senha_erro']) || !empty($dados['confirma_senha_erro']) || !empty($dados['termos_erro'])):?> 
      <div class="alert alert-danger">Por favor, corrija os erros abaixo</div>
    <?php endif;?>

    <div class="form-floating">
      <input value="<?=$dados['nome']?>" name="nome" type="text" class="form-control" id="floatingInput" placeholder="Nome do usuário">
      <label for="floatingInput">Nome de usuário </label>
    </div>

    <?= Sessao::mensagem('nome_erro')?>

    <div class="form-floating">
      <input value="<?=$dados['email']?>" name="email" type="email" class="form-control mb-0 rounded-2" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Email</label>
    </div>

    <?= Sessao::mensagem('email_erro')?>

    <div class="form-floating">
      <input value="<?=$dados['senha']?>" name="senha" type="password" class="form-control mb-0 rounded-2" id="floatingPassword" placeholder="Senha">
      <label for="floatingPassword">Senha</label>
    </div>

    <?= Sessao::mensagem('senha_erro')?>

    <div class="form-floating">
      <input value="<?=$dados['confirma_senha']?>" name="confirma_senha" type="password" class="form-control rounded-3" id="floatingPassword" placeholder="Confirmar Senha">
      <label for="floatingPassword">Confirmar Senha</label>
    </div>
    
    <?= Sessao::mensagem('confirma_senha_erro')?>

    <div class="my-2">Já tem uma conta? <a href="<?=URL?>/usuario/login">Entrar</a></div>

    <div class="form-check text-start my-3">
      <input name="termos" class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
      <label class="form-check-label" for="flexCheckDefault">
        Aceito termos e condições
      </label>
    </div>

    <?= Sessao::mensagem('termos_erro')?>

    <button class="btn btn-primary w-100 py-2 mb-5 mt-5" value="Cadastrar" type="submit">Cadastrar</button>
  </form>
</main>