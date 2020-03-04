<?php require RUTA.'/vistas/inc/header.php';?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
           <h3 class="titulo_form">PERSONAL</h3>
        </div>
        
        <form action="<?php echo '/sisvideo/personal/update/'.$datos['personal']->cod_personal;?>" method="post">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="titulo_panel">EDITAR PERSONAL</h2>
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
                                    <input type="text" name="name" class="form-control" value="<?php echo $datos['personal']->name;?>" required autofocus>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Apellidos(s)*:</label>
                                    <input type="text" name="last_name" class="form-control" value="<?php echo $datos['personal']->last_name;?>" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Teléfono/Celular(s)*:</label>
                                    <input type="text" name="phone" class="form-control" value="<?php echo $datos['personal']->phone;?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Carnet de identidad*:</label>
                                <input type="number" name="ci" id="ci" value="<?php echo $datos['personal']->ci;?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                                <label>Expedido*:</label>
                                <select name="issued" id="issued" class="form-control" required>
                                    <option value="" disabled selected>Seleccione</option>
                                    <option value="LP" <?php if($datos['personal']->issued =='LP') echo 'selected';?>>LA PAZ</option>
                                    <option value="CB" <?php if($datos['personal']->issued =='CB') echo 'selected';?>>COCHABAMBA</option>
                                    <option value="SC" <?php if($datos['personal']->issued =='SC') echo 'selected';?>>SANTA CRUZ</option>
                                    <option value="PT" <?php if($datos['personal']->issued =='PT') echo 'selected';?>>POTOSI</option>
                                    <option value="CH" <?php if($datos['personal']->issued =='CH') echo 'selected';?>>CHUQUISACA</option>
                                    <option value="TJ" <?php if($datos['personal']->issued =='TJ') echo 'selected';?>>TARIJA</option>
                                    <option value="BN" <?php if($datos['personal']->issued =='BN') echo 'selected';?>>BENI</option>
                                    <option value="PD" <?php if($datos['personal']->issued =='PD') echo 'selected';?>>PANDO</option>
                                    <option value="OR" <?php if($datos['personal']->issued =='OR') echo 'selected';?>>ORURO</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Correo*:</label>
                                    <input type="email" name="email" class="form-control" value="<?php echo $datos['personal']->email;?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Usuario*:</label>
                                    <select name="type" id="type" class="form-control" required>
                                        <option value="" disabled selected>Seleccione</option>
                                        <option value="ADMINISTRADOR" <?php if($datos['personal']->tipo =='ADMINISTRADOR') echo'selected';?>>ADMINISTRADOR</option>
                                        <option value="AUXILIAR" <?php if($datos['personal']->tipo =='AUXILIAR') echo'selected';?>>AUXILIAR</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success">Actualizar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


