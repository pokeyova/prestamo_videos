<?php
    require_once RUTA.'/modelos/MPersonal.php';
    session_start();
    $personal = new MPersonal();
    $infoPersonal = $personal->personalUsuario($_SESSION['cod_user']);
    if(!isset($_SESSION['cod_user']) && !isset($_SESSION['name']) && !isset($_SESSION['type']))
    {
        header('location:/sisvideo');
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Club Videos</title>
    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo RUTA_URL; ?>/public/assets/bootstrap-3.3.7/dist/css/bootstrap.css">

    <!-- JQuery DataTable Css -->
    <link href="<?php echo RUTA_URL; ?>/public/assets/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo RUTA_URL; ?>/public/assets/fontawesome/css/all.css">
    <link rel="stylesheet" href="<?php echo RUTA_URL; ?>/public/css/miEstilo.css">
    <link rel="stylesheet" href="<?php echo RUTA_URL; ?>/public/css/clienteCreate.css">
    <link rel="stylesheet" href="<?php echo RUTA_URL; ?>/public/css/prestamos.css">
</head>
<body>


<header id="header">
    <div class="logo">
        <img src="<?php echo RUTA_URL.'/public/imgs/logo.jpg';?>" alt="logo">
    </div>
    <div class="empresa">
        <h1>PRÉSTAMO DE VIDEOS</h1>
    </div>
    <div class="usuario">
        <div class="icono">
            <i class="far fa-user"></i>
        </div>
        <div class="nom_usuario">
            <?php if($infoPersonal) echo $infoPersonal->name.' '.$infoPersonal->last_name; else echo $_SESSION['name'];?>
        </div>
        <div class="tipo">
            <?php echo $_SESSION['type'];?>
        </div>
        <div class="estado">
            <span>Activo</span> <i class="fa fa-circle"></i>
        </div>
    </div>
</header>
<nav class="navbar navbar-default" id="nav_bar">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- <a class="navbar-brand" href="/sisvideo/borrowing">PRESTAMOS</a> -->
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php if($_SESSION['type'] == 'ADMINISTRADOR') :?>
                    <?php require RUTA.'/vistas/includes/menuAdmin.php';?>
                <?php endif;?>
                <?php if($_SESSION['type'] == 'AUXILIAR') :?>
                    <?php require RUTA.'/vistas/includes/menuAuxiliar.php';?>
                <?php endif;?>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="<?php echo RUTA_URL;?>/login/logout">
                        <i class="fa fa-sign-in-alt"></i>
                        <span>SALIR</span>
                    </a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
