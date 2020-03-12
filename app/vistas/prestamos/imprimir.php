<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo RUTA_URL; ?>/public/assets/bootstrap-3.3.7/dist/css/bootstrap.css" media="all">
    <link rel="stylesheet" href="<?php echo RUTA_URL; ?>/public/css/verPrestamo.css" media="screen">
    <link rel="stylesheet" href="<?php echo RUTA_URL; ?>/public/css/impresion.css" media="print">
</head>
<body>
    <?php if(isset($_GET['bien'])): ?>
    <div class="alert alert-success">
        <button class="close" data-dismiss="alert">&times;</button>
        Registro guardado con éxito
    </div>
    <?php endif; ?>

    <?php if(isset($_GET['error'])): ?>
    <div class="alert alert-warning">
        <button class="close" data-dismiss="alert">&times;</button>
        Algo salió mal intente nuevamente
    </div>
    <?php endif; ?>
            
    <img src="<?php echo RUTA_URL; ?>/public/imgs/logo.jpg" class="logo_factura" alt="">
    <div class="titulo">
        <h2><?php echo $datos['empresa'];?></h2>
        <p class="dir">La Paz-Bolivia, Zona los olivos calle los heroes #32</p>
    </div>

    <div class="titulo_derecha">
        <h2>Factura</h2>
        <div class="contenedor_info">
            <p class="info"><strong>NIT: </strong><span>1000150052</span></p>
            <p class="info"><strong>FACTURA N°: </strong><span><?php echo $datos['factura']->cod_invoice;?></span></p>
            <p class="info"><strong>AUTORIZACIÓN: </strong><span>10002134567</span></p>
        </div>
    </div>
    <div class="datos_factura">
        <div class="facturar_a">
            <p><strong>Cliente: </strong> <?php echo $datos['prestamo']->cliente?></p>
            <p><strong>NIT/C.I.: </strong> <?php echo $datos['prestamo']->nit?></p>
        </div>
        <div class="num_fac">
            <p><strong>Fecha: </strong> <?php echo date('d/m/Y',strtotime($datos['prestamo']->borrow_date));?></p>
            <p><strong>Fecha devolución: </strong> <?php echo date('d/m/Y',strtotime($datos['prestamo']->return_date));?></p>
        </div>
    </div>
   

    <div class="info1">
        "ESTA FACTURA CONTRIBUYE AL DESARROLLO DEL PAÍS EL USO ILÍCITO DE ÉSTA SERA SANCIONADO A LEY"
    </div>
    <div class="info2">
        Ley Nº 453: El proveedor debe exhibir certificaciones de habilitación o documentos que acrediten las capacidades u ofertas de servicios.
    </div>

    <!-- SCRIPTS -->
    <script src="<?php echo RUTA_URL; ?>/public/assets/jquery-3.2.1.js"></script>
    <script>
        $(document).ready(function () {
            window.print();
        });
    </script>
</body>
</html>