
<div class="col-xl-4 col-md-6 mx-auto p-5">

  <form name="cadastrar" id="cadastrar" method="post">
    <a href="home">
      <img class="mb-4" src="<?=URL?>/public/img/earth-483978_640.png" alt="" width="40" style="object-fit: cover;">
    </a>
    <h1 class="h3 mb-3 fw-normal">Cadastrar Usuário</h1>

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
      <input value="<?=$dados['senha']?>" name="senha" type="password" class="form-control mb-0 rounded-2" id="floatingPassword" placeholder="Senha">
      <label for="floatingPassword">Senha</label>
    </div>

    <?php if (!empty($dados['senha_erro'])):?>
      <div class="alert alert-danger"><?=$dados['senha_erro']?></div>
    <?php endif;?>

    <div class="form-floating">
      <input value="<?=$dados['confirma_senha']?>" name="confirma_senha" type="password" class="form-control rounded-3" id="floatingPassword" placeholder="Confirmar Senha">
      <label for="floatingPassword">Confirmar Senha</label>
    </div>
    
    <?php if (!empty($dados['confirma_senha_erro'])):?>
      <div class="alert alert-danger"><?=$dados['confirma_senha_erro']?></div>
    <?php endif;?>

    <div class="my-2">Já tem uma conta? <a href="<?=URL?>/usuarios/login">Entrar</a></div>

    <div class="form-check text-start my-3">
      <input   name="termos" class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
      <label class="form-check-label" for="flexCheckDefault">
        Aceito termos e condições
      </label>
    </div>

    <?php if (!empty($dados['termos_erro'])):?>
      <div class="alert alert-danger"><?=$dados['termos_erro']?></div>
    <?php endif;?>

    <button class="btn btn-primary w-100 py-2" type="submit">Cadastrar</button>

  </form>

</div>



