<?php require RUTA.'/vistas/inc/header.php';?>
<?php $borrowing = new MBorrowing();?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
           <h3 class="titulo_form">PRÉSTAMOS</h3>
        </div>
        
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="titulo_panel">VER PRÉSTAMO</h2>
                </div>
                <div class="panel-body" style="padding: 60px 60px 60px 100px;">
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
                    
                    <div class="row">
                        <div class="col-md-12">
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
                        </div>
                    </div>
                    
        </div>

    </div>
</div>
<br><br>


<?php require RUTA.'/vistas/inc/footer.php';?>


