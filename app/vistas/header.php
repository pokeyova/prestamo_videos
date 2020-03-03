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
