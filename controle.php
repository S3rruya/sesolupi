<?php
@session_start();

//verificação de login
include_once("includes/check_login.php");

//header do sistema
include_once("includes/header.php");

//classes
include_once("classes/load_classes.php");

$link = @array_filter(explode("/", $_GET['pasta']));

?>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between text-center">
                        <div class="logo w-100">
                            <a href="controle/"><img src="<?php echo URL_UPLOAD;?>assets/images/logo/logo.png" alt="Logo"></a>
                        </div>
                        <div class="toggler">
                            <a href="javascript:void(0);" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item <?php if($link['0'] == ""){ echo 'active';}?> ">
                            <a href="controle/" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-item <?php if($link['0'] == "clientes"){ echo 'active';}?>">
                            <a href="controle/clientes" class='sidebar-link'>
                                <i class="bi fas fa-users"></i>
                                <span>Clientes</span>
                            </a>
                        </li>

                        <li class="sidebar-item <?php if($link['0'] == "medicos"){ echo 'active';}?>">
                            <a href="controle/medicos" class='sidebar-link'>
                                <i class="bi fas fa-user-md"></i>
                                <span>Médicos</span>
                            </a>
                        </li>


                        <li class="sidebar-item <?php if($link['0'] == "obitos"){ echo 'active';}?>">
                            <a href="controle/obitos" class='sidebar-link'>
                                <i class="bi fas fa-cross"></i>
                                <span>Óbitos</span>
                            </a>
                        </li>

                        <li class="sidebar-item has-sub <?php if($link['0'] == "configuracao"){ echo 'active';}?>">
                            <a href="controle/configuracao" class='sidebar-link'>
                                <i class="bi fas fa-user-cog"></i>
                                <span>Ajustes</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="controle/configuracao/usuarios">Usuários</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="controle/configuracao/configuracao">Configuração</a>
                                </li>                                
                            </ul>
                        </li>


                        <li class="sidebar-item <?php if($link['0'] == "logout"){ echo 'active';}?>">
                            <a href="controle/logout" class='sidebar-link'>
                                <i class="bi fas fa-sign-out-alt"></i>
                                <span>Sair</span>
                            </a>
                        </li>

                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main" class='layout-navbar'>
<header class='mb-3'>
                <nav class="navbar navbar-expand navbar-light ">
                    <div class="container-fluid">
                        <a href="javascript:void(0);" class="burger-btn d-block">
                            <i class="bi bi-justify fs-3"></i>
                        </a>

                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                                <!-- <li class="nav-item dropdown me-1">
                                    <a class="nav-link active dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class='bi bi-envelope bi-sub fs-4 text-gray-600'></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                        <li>
                                            <h6 class="dropdown-header">Mail</h6>
                                        </li>
                                        <li><a class="dropdown-item" href="#">No new mail</a></li>
                                    </ul>
                                </li> -->
                                <!-- <li class="nav-item dropdown me-3">
                                    <a class="nav-link active dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class='bi bi-bell bi-sub fs-4 text-gray-600'></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                        <li>
                                            <h6 class="dropdown-header">Notifications</h6>
                                        </li>
                                        <li><a class="dropdown-item">No notification available</a></li>
                                    </ul>
                                </li> -->
                            </ul>
                            <div class="dropdown">
                                <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="user-menu d-flex">
                                        <div class="user-name text-end me-3">
                                            <h6 class="mb-0 text-gray-600"><?php echo $_SESSION['fran_nome'];?></h6>
                                            <p class="mb-0 text-sm text-gray-600">Administrator</p>
                                        </div>
                                        <div class="user-img d-flex align-items-center">
                                            <div class="avatar avatar-md">
                                                <img src="<?php echo get_gravatar($_SESSION['fran_email']);?>">
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <h6 class="dropdown-header">Olá, <?php echo $_SESSION['fran_nome'];?></h6>
                                    </li>
                                    <li><a class="dropdown-item" href="#"><i class="icon-mid bi bi-person me-2"></i> Meu perfil</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="icon-mid bi bi-gear me-2"></i> Troca senha</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="controle/logout"><i class="icon-mid bi bi-box-arrow-left me-2"></i> Sair</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>
            <div id="main-content">


            <?php
            $pastabase = "includes/";
            if(@$link['0']){
                if( @is_dir($pastabase.$link['0']) ){
                    if(@$link['1'] != NULL AND @is_numeric($link['1']) == true){
                    //echo "<h1>1</h1>";
                        $paginaincluir = $link['0']."/home.php";
                    }
                    elseif(@$link['1'] != NULL AND @is_numeric($link['1']) == false){
                    //echo "<h1>2</h1>";
                        $paginaincluir = $link['0']."/".$link['1'].".php"; 
                    }
                    else{
                        //echo "<h1>4</h1>";
                        $paginaincluir = $link['0']."/home.php";
                    }
                }
                elseif( @is_file($pastabase.$link['0'].".php") ){
                    //echo "<h1>5</h1>";
                    $paginaincluir = $link['0'].".php";
                }
                else{
                    //echo "<h1>6</h1>";
                    $paginaincluir = "erros/404.php";
                }
            }else{
                $paginaincluir = "home/home.php";
            }
            // echo "<h1>".$paginaincluir."</h1>";
            ?>
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <!-- <h3 class="upptitle"><?php echo @str_replace("_", " ", $link['0']) ;?></h3> -->
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">

                          <ul class=" breadcrumb">
                            <li class="breadcrumb-item">
                              <a href="controle/">Dashboard</a>
                            </li>
                            <?php
                            if(@$link['0']){
                            ?>
                            <li class="breadcrumb-item upptitle">
                              <a href="controle/<?php echo $link['0'];?>/"><?php echo str_replace("_", " ", $link['0']) ;?></a>
                            </li>
                            <?php }
                            if(@$link['1']){
                            ?>
                            <li class="breadcrumb-item upptitle">
                              <span><?php echo str_replace("_", " ", $link['1']) ;?></span>
                            </li> 
                            <?php }?>
                          </ul>

   

                        </nav>
                    </div>
                </div>
            </div>
            <?php
            $tipodeacesso = checkfileperm($pastabase.$paginaincluir,1);
            $check_niveldeacesso= LEVELACCESS;

            //  echo $check_niveldeacesso." - ".$tipodeacesso;

            if (@file_exists($pastabase.$paginaincluir)) {
                if($tipodeacesso <= $check_niveldeacesso){
                    include_once($pastabase.$paginaincluir);
                }else{
                    include_once($pastabase."erros/nao_autorizado.php");
                }
            } 
            else {
                include_once($pastabase."erros/404.php");
            }
            ?>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2021 &copy; Versão 1.0</p>
                    </div>
                    <div class="float-end">
                        <p>Feito por <a
                                href="https://web4comunicacao.com" target="_blank">Web4 Comunicação</a></p>
                    </div>
                </div>
            </footer>
        </div>
        </div>
    </div>

<div class="loader-wrapper">
  <span class="loader">
    <img src="assets/images/loading.gif">
  </span>
</div>

<?php include_once('includes/footer.php'); ?>
