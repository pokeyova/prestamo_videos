<?php require RUTA.'/vistas/inc/header.php';?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
           <h3 class="titulo_form">CLIENTE</h3>
        </div>
        
        <form action="<?php echo '/sisvideo/client/store';?>" method="post">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="titulo_panel">REGISTRAR CLIENTE</h2>
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
                                    <input type="text" name="name" class="form-control" value="" required autofocus>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Apellidos(s)*:</label>
                                    <input type="text" name="last_name" class="form-control" value="" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Fecha de nacimiento*:</label>
                                    <input type="date" name="date_birth" class="form-control" value="" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Carnet de identidad*:</label>
                                <input type="number" name="ci" id="ci" class="form-control" required>
                            </div>
                            <div class="col-md-2">
                                <label>Expedido*:</label>
                                <select name="issued" id="issued" class="form-control" required>
                                    <option value="" disabled selected>Seleccione</option>
                                    <option value="LP">LA PAZ</option>
                                    <option value="CB">COCHABAMBA</option>
                                    <option value="SC">SANTA CRUZ</option>
                                    <option value="PT">POTOSI</option>
                                    <option value="CH">CHUQUISACA</option>
                                    <option value="TJ">TARIJA</option>
                                    <option value="BN">BENI</option>
                                    <option value="PD">PANDO</option>
                                    <option value="OR">ORURO</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Correo*:</label>
                                    <input type="email" name="email" class="form-control" value="" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Dirección*:</label>
                                    <input type="text" name="address" class="form-control" value="" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Geolocalización*:</label>
                                    <textarea name="location" id="location" rows="4" class="form-control" required></textarea>
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



