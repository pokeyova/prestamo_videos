<?php require RUTA.'/vistas/inc/header.php';?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
           <h3 class="titulo_form">CLIENTE</h3>
        </div>
        
        <form action="<?php echo '/sisvideo/client/update/'.$datos['cliente']->cod_client;?>" method="post">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="titulo_panel">DATOS DEL CLIENTE</h2>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Nombre:</label> <?php echo $datos['cliente']->name.' '.$datos['cliente']->last_name;?>
                                </div>
                                <div class="form-group">
                                    <label>Carnet de identidad:</label> <?php echo date('Y-m-d',strtotime($datos['cliente']->date_birth));?>
                                </div>
                                <div class="form-group">
                                    <label>Fecha de nacimiento:</label> <?php echo $datos['cliente']->ci.' '.$datos['cliente']->issued;?>
                                </div>
                                <div class="form-group">
                                    <label>Correo:</label> <?php echo $datos['cliente']->email;?>
                                </div>
                                <div class="form-group">
                                    <label>Estado:</label> <?php if($this->client->bloqueo($datos['cliente']->cod_client)): ?> BLOQUEADO<?php else: ?> ACTIVO<?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <label>Dirección*:</label>
                                <div id="contenedor-map">
                                <?php echo $datos['cliente']->location;?>
                                </div>
                                &nbsp;&nbsp;&nbsp;<?php echo $datos['cliente']->address;?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php require RUTA.'/vistas/inc/footer.php';?>

<script src="<?php echo RUTA_URL;?>/public/js/geolocalizacion.js"></script>

</body>
</html>