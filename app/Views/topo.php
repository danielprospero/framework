<header class="p-3 mb-3 border-bottom">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
          <img src="<?=URL?>/public/img/earth-483978_640.png" alt="Framework" width="30" height="32">
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="<?=URL?>" class="nav-link px-2 link-secondary">Home</a></li>
          <li><a href="#" class="nav-link px-2 link-body-emphasis">Blog</a></li>
          <li><a href="#" class="nav-link px-2 link-body-emphasis">Sobre</a></li>
          <li><a href="#" class="nav-link px-2 link-body-emphasis">Contato</a></li>
        </ul>

        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
          <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
        </form>

        <?php if(isset($_SESSION['usuario_id'])): ?>
          <div class="dropdown text-end ">
            <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="<?= URL ?>/public/img/team-image-1-646x680.jpg" alt="mdo" width="32" height="32" class="rounded-circle">
            </a>
            <ul class="dropdown-menu text-small">
              <li><p class="dropdown-item">Olá, <?php echo explode(' ', $_SESSION['usuario_nome'])[0];?></p></li>
              <li><a class="dropdown-item" href="#">New project...</a></li>
              <li><a class="dropdown-item" href="#">Settings</a></li>
              <li><a class="dropdown-item" href="#">Perfil</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="<?= URL ?>/usuarios/sair">Sair</a></li>
            </ul>
          </div>
        <?php else: ?>
          <div class="text-end">
              <a href="<?= URL ?>/usuarios/login" class="btn btn-outline-primary me-2" title="Tem uma conta? Faça login">Entrar</a>
              <a href="<?= URL ?>/usuarios/cadastrar" class="btn btn-primary" data-tooltipo="tooltip" title="Não tem uma conta? Cadastre-se">Cadastre-se</a>
          </div>
        <?php endif;?>
      </div>
    </div>
</header>