<?php require RUTA.'/vistas/inc/header.php';?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
           <h3 class="titulo_form">GÉNEROS</h3>
        </div>
        
        <form action="<?php echo '/sisvideo/genre/update/'.$datos['genre']->id;?>" method="post">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="titulo_panel">EDITAR GÉNERO</h2>
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
                                    <label>Nombre*:</label>
                                    <input type="text" name="name" class="form-control" value="<?php echo $datos['genre']->name;?>" required autofocus>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Descripción:</label>
                                    <input type="text" name="description" class="form-control" value="<?php echo $datos['genre']->description;?>">
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
            </div>
        </form>
    </div>
</div>

<?php require RUTA.'/vistas/inc/footer.php';?>

</body>
</html>
