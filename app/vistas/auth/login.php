<?php 
    $old_name = '';
    if(isset($_GET['name']))
    {
        $old_name = $_GET['name'];
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>

    <link rel="stylesheet" href="<?php echo RUTA_URL; ?>/public/assets/bootstrap-3.3.7/dist/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo RUTA_URL; ?>/public/assets/fontawesome/css/all.css">
    <link rel="stylesheet" href="<?php echo RUTA_URL; ?>/public/css/login.css">
</head>
<body>

<div class="contenedor-login">
    <div class="header-login">
        <h1 class="titulo-empresa"><?php echo $datos['empresa'];?></h1>
        <img src="<?php echo RUTA_URL; ?>/public/imgs/logo.jpg" class="logo-empresa" alt="Logo">
    </div>
    <div class="body-login">
        <h3 class="titulo-form">INICIAR SESIÓN</h3>
        <form action="<?php echo RUTA_URL; ?>/login/comprueba" method="POST">
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-user"></i>
                </span>
                <input type="text" name="name" value="<?php echo $old_name; ?>" placeholder="Usuario" required class="form-control" autofocus>
            </div>
            <br>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-key"></i>
                </span>
                <input type="password" name="password" placeholder="Contraseña" required class="form-control">
            </div>
            <br>
            <?php if(isset($_GET['name'])):?>
                <div class="form-group">
                    <div class="alert alert-danger">
                        El usuario o contraseña son incorrectos
                    </div>
                </div>
            <?php endif;?>
            <div class="form-group" style="display:flex; justify-content: center;">
                <button type="submit" class="btn btn-default">Acceder</button>
            </div>
        </form>
    </div>
</div>

<script src="<?php echo RUTA_URL; ?>/public/assets/jquery-3.2.1.js"></script>
<script src="<?php echo RUTA_URL; ?>/public/assets/bootstrap-3.3.7/dist/js/bootstrap.js"></script>
<script>
    console.log('XXXXXXXXXXXXXXXXXXXXXXXXXX');
    $("input[type=text]").focus(function(){
        this.select();
    });
</script>
</body>
</html>