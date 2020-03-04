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
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>



