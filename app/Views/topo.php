<header class="container-fluid border-bottom">
    <div class="container">
        <nav class="navbar navbar-expand-lg  rounded" aria-label="Eleventh navbar example">
            <div class="container-fluid">
                <a href="<?=URL?>" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
                    <img class="bi me-2" src="<?=URL?>/public/img/logo.svg" alt="Logo" width="80" height="60" style="object-fit: cover;">
                </a>            
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarsExample09">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li><a href="<?=URL?>" class="nav-link px-2 <?=$url[0] == 'home' ? 'link-secondary' : 'link-body-emphasis'?>">Home</a></li>
                        <li><a href="<?=URL?>/paginas/blog" class="nav-link px-2  <?=$url[0] == 'blog' ? 'link-secondary' : 'link-body-emphasis'?>">Blog</a></li>
                        <li><a href="<?=URL?>/paginas/sobre" class="nav-link px-2  <?=$url[0] == 'sobre' ? 'link-secondary' : 'link-body-emphasis'?>">Sobre</a></li>
                        <li><a href="<?=URL?>/paginas/contato" class="nav-link px-2 <?=$url[0] == 'contato' ? 'link-secondary' : 'link-body-emphasis'?>">Contato</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle <?=$url[0] == 'categoria' ? 'link-secondary' : 'link-body-emphasis'?>" href="#" data-bs-toggle="dropdown" aria-expanded="false">Categoria</a>
                            <ul class="dropdown-menu text-small">
                                <?php var_dump($dados); ?>
                                <?php foreach($dados['categorias'] as $categoria): ?>
                                    <li><a class="dropdown-item" href="<?=URL?>/categorias/<?=$categoria['slug']?>"><?=$categoria['nome']?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                    </ul>
                    <form action="<?=URL?>/pesquisa" class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                        <input value="<?=$_GET['find'] ?? ''?>" name="find" type="search" class="form-control" placeholder="Pesquisar..." aria-label="Search">
                    </form>     
                    <div class="text-end">
                        <?php if(isset($_SESSION['usuario_id'])): ?>
                            <div class="dropdown">
                                <a href="#" class="d-block link-body-emphasis dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="<?=URL?>/<?=$_SESSION['usuario_imagem'];?>" alt="Foto de perfil" width="32" height="32" class="rounded-circle">
                                </a>
                                <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                                    <li><a class="dropdown-item" href="<?=URL?>/usuario/perfil/<?=$_SESSION['usuario_id']?>">Perfil</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <?php if($_SESSION['usuario_acesso_id'] == 1): ?>
                                        <li><a class="dropdown-item" href="<?=URL?>/admin">Admin</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                    <?php endif; ?>
                                    <li><a class="dropdown-item" href="<?=URL?>/usuario/sair">Sair</a></li>
                                </ul>
                            </div>
                        <?php else: ?>
                            <a href="<?=URL?>/usuario/cadastrar" class="btn btn-outline-primary me-2">Cadastrar</a>
                            <a href="<?=URL?>/usuario/login" class="btn btn-outline-primary">Login</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </nav>    
    </div> 
</header>



