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
                </div>
            </div>
        </form>
    </div>
</div>


