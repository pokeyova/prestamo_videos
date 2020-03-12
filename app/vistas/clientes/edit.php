<?php require RUTA.'/vistas/inc/header.php';?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
           <h3 class="titulo_form">CLIENTE</h3>
        </div>
        
        <form action="<?php echo '/'.APP_NAME.'/client/update/'.$datos['cliente']->cod_client;?>" method="post">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="titulo_panel">EDITAR CLIENTE</h2>
                    </div>
                    <div class="panel-body">
                        <?php if(isset($_GET['error'])): ?>
                        <div class="alert alert-danger">
                            <button class="close" data-dismiss="alert">&times;</button>
                            Algo salió mal intente nuevamente por favor
                        </div>
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nombre(s)*:</label>
                                    <input type="text" name="name" class="form-control" value="<?php echo $datos['cliente']->name;?>" required autofocus>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Apellidos(s)*:</label>
                                    <input type="text" name="last_name" class="form-control" value="<?php echo $datos['cliente']->last_name;?>" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Fecha de nacimiento*:</label>
                                    <input type="date" name="date_birth" class="form-control" value="<?php echo date('Y-m-d',strtotime($datos['cliente']->date_birth));?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Carnet de identidad*:</label>
                                <input type="number" name="ci" id="ci" value="<?php echo $datos['cliente']->ci;?>" class="form-control" required>
                            </div>
                            <div class="col-md-2">
                                <label>Expedido*:</label>
                                <select name="issued" id="issued" class="form-control" required>
                                <option value="" disabled selected>Seleccione</option>
                                    <option value="LP" <?php if($datos['cliente']->issued =='LP') echo 'selected';?>>LA PAZ</option>
                                    <option value="CB" <?php if($datos['cliente']->issued =='CB') echo 'selected';?>>COCHABAMBA</option>
                                    <option value="SC" <?php if($datos['cliente']->issued =='SC') echo 'selected';?>>SANTA CRUZ</option>
                                    <option value="PT" <?php if($datos['cliente']->issued =='PT') echo 'selected';?>>POTOSI</option>
                                    <option value="CH" <?php if($datos['cliente']->issued =='CH') echo 'selected';?>>CHUQUISACA</option>
                                    <option value="TJ" <?php if($datos['cliente']->issued =='TJ') echo 'selected';?>>TARIJA</option>
                                    <option value="BN" <?php if($datos['cliente']->issued =='BN') echo 'selected';?>>BENI</option>
                                    <option value="PD" <?php if($datos['cliente']->issued =='PD') echo 'selected';?>>PANDO</option>
                                    <option value="OR" <?php if($datos['cliente']->issued =='OR') echo 'selected';?>>ORURO</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Correo*:</label>
                                    <input type="email" name="email" class="form-control" value="<?php echo $datos['cliente']->email;?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Dirección*:</label>
                                    <input type="text" name="address" class="form-control" value="<?php echo $datos['cliente']->address;?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Geolocalización*:</label>
                                    <textarea name="location" id="location" rows="4" class="form-control" required><?php echo $datos['cliente']->location;?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Vista previa:</label>
                                <input type="hidden" name="urlImg" id="urlImg" value="<?php echo RUTA_URL.'/public/imgs/iconoMaps.jpg';?>">
                                <div id="contenedor-map">
                                    <img src="<?php echo RUTA_URL.'/public/imgs/iconoMaps.jpg';?>" alt="Imagen">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success">Registrar</button>
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
