
<?php


$pagina = isset($_GET['url']) ? $_GET['url'] : 'admin';

switch($pagina){

    case 'admin':
        $pagina = '../app/Views/admin/index.php';
        break;
    case 'admin/dashboard':
        $pagina = '../app/Views/admin/dashboard.php';
        break;
    case 'admin/categorias/index':
        $pagina = '../app/Views/admin/categorias/index.php';
        break;
    case 'admin/categorias/cadastrar':
        $pagina = '../app/Views/admin/categorias/cadastrar.php';
        break;
    case 'admin/categorias/editar':
        $pagina = '../app/Views/admin/categorias/editar.php';
        break;
    case 'admin/categorias/delete':
        $pagina = '../app/Views/admin/categorias/delete.php';
        break;
    case 'admin/posts/index':
        $pagina = '../app/Views/admin/posts/index.php';
        break;
    case 'admin/posts/cadastrar':
        $pagina = '../app/Views/admin/posts/cadastrar.php';
        break;
    case 'admin/posts/editar':
        $pagina = '../app/Views/admin/posts/editar.php';
        break;
    case 'admin/posts/delete':
        $pagina = '../app/Views/admin/posts/delete.php';
        break;
    case 'admin/usuarios/index':
        $pagina = '../app/Views/admin/usuarios/index.php';
        break;
    case 'admin/usuarios/cadastrar':
        $pagina = '../app/Views/admin/usuarios/cadastrar.php';
        break;
    case 'admin/usuarios/editar':
        $pagina = '../app/Views/admin/usuarios/editar.php';
        break;
    case 'admin/usuarios/delete':
        $pagina = '../app/Views/admin/usuarios/delete.php';
        break;
    case 'admin/usuarios/perfil':
        $pagina = '../app/Views/admin/usuarios/perfil.php';
        break;
    case 'admin/usuarios/sair':
        $pagina = '../app/Views/admin/usuarios/sair.php';
        break;
    default:
        $pagina = '../app/Views/admin/index.php';
        break;
}

?>
<div class="container-fluid ">
    <div class="row">
        <div class="col-lg-2">
            <div class="d-flex flex-column p-4" >
                <a href="#" class="d-flex align-items-center text-decoration-none">
                    <span class="fs-4">Menu</span>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="<?=URL?>/admin" class="nav-link <?=$pagina == '../app/Views/admin/index.php' ? 'active' : ''?>">
                            <i class="bi bi-house-fill"> Home</i> 
                        </a>
                    </li>
                    <li>
                        <a href="<?=URL?>/admin/dashboard" class="nav-link <?=$pagina == '../app/Views/admin/dashboard.php' ? 'active' : ''?>" >
                            <i class="bi bi-speedometer2"> Dashboard</i>
                        </a>
                    </li>
                    <li>
                        <a href="<?=URL?>/admin/posts/index" class="nav-link <?=$pagina == '../app/Views/admin/posts/index.php' ? 'active' : ''?>">
                            <i class="bi bi-file-post"> Posts</i>                        
                        </a>
                    </li>
                    <li>
                        <a href="<?=URL?>/admin/categorias/index" class="nav-link <?=$pagina == '../app/Views/admin/categorias/index.php' ? 'active' : ''?>">
                            <i class="bi bi-tags-fill"> Categorias</i>                   
                        </a>
                    </li>
                    <li>
                        <a href="<?=URL?>/admin/usuarios/index" class="nav-link  <?=$pagina == '../app/Views/admin/usuarios/index.php' ? 'active' : ''?>">
                            <i class="bi bi-people-fill">   Usuários</i> 
                        </a>
                    </li>
                </ul>
                <hr>
            </div>
        </div>


        
        <div class="col-lg-10">
            <div class='tabs-content m-4'>
                
            <?php 

                require_once $pagina;

            ?>

            </div>
        </div>
    </div>
</div>