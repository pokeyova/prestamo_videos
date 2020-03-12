<?php require RUTA.'/vistas/inc/header.php';?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
           <h3 class="titulo_form">VIDEOS</h3>
        </div>
        
        <form action="<?php echo '/'.APP_NAME.'/video/store';?>" method="post">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="titulo_panel">REGISTRAR VIDEO</h2>
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
                                    <label>Código*:</label>
                                    <input type="text" name="cod_video" class="form-control" value="<?php echo $datos['codigo'];?>" required readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Título*:</label>
                                    <input type="text" name="title" class="form-control" value="" required autofocus>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Duración (minutos)*:</label>
                                    <input type="number" min="1" name="duration" class="form-control" value="" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Año de publicación*:</label>
                                    <input type="number" min="0" name="year_publication" class="form-control" value="" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Género*:</label>
                                    <select name="genre_id" id="genre_id" class="form-control" required>
                                        <option value="" disabled selected>Seleccione</option>
                                    <?php foreach ($datos['generos'] as $key => $genero): ?>
                                        <option value="<?php echo $genero->id?>"><?php echo $genero->name;?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Costo unitario (Bs.)*:</label>
                                    <select name="cod_cost" id="cod_cost" class="form-control" required>
                                        <option value="" disabled selected>Seleccione</option>
                                    <?php foreach ($datos['costos'] as $key => $costo): ?>
                                        <option value="<?php echo $costo->cod_cost?>"><?php echo $costo->cod_cost.' - '.$costo->unit_cost.' Bs.';?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Unidades adquiridas*:</label>
                                    <input type="number" min="0" value="1" name="quantity" class="form-control" value="" required>
                                </div>
                            </div>

                        </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <!-- TITULOS ALTERNATIVOS -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="titulo_panel">TITULOS ALTERNATIVOS</h2>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Titulo alternativo: </label> 
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="txtTitulo" placeholder="Alternativo">
                                        <div class="input-group-btn">
                                            <button class="btn btn-default" type="button" id="btnAgregarTitulo"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <br>
                        <div class="col-md-12">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="20px">Nº</th>
                                        <th>Título</th>
                                        <th width="20px">Acción</th>
                                    </tr>
                                </thead>
                                <tbody id="contenedorFilasTitulos">
                                    <tr class="odd">
                                        <td colspan="3">No hay registros</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <!-- NOMINACIONES -->
                <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="titulo_panel">NOMINACIONES</h2>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nominacion: </label> 
                                    <input type="text" class="form-control" id="txtNominacion" placeholder="Nominación">
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <select type="text" class="form-control" placeholder="Gano" id="txtNominacionGano" placeholder="Nominación">
                                            <option value="SI">GANO</option>
                                            <option value="NO">NO GANO</option>
                                        </select>
                                        <div class="input-group-btn">
                                            <button class="btn btn-default pull-right" type="button" id="btnAgregarNominacion"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <br>
                        <div class="col-md-12">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="20px">Nº</th>
                                        <th>Nominación</th>
                                        <th>Gano</th>
                                        <th width="20px">Acción</th>
                                    </tr>
                                </thead>
                                <tbody id="contenedorFilasNominaciones">
                                    <tr class="odd">
                                        <td colspan="4">No hay registros</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <!-- ACTORES PRINCIPALES -->
                <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="titulo_panel">ACTORES PRINCIPALES</h2>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nombre: </label> 
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="txtActor" placeholder="Nombre">
                                        <div class="input-group-btn">
                                            <button class="btn btn-default" type="button" id="btnAgregarActor"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <br>
                        <div class="col-md-12">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="20px">Nº</th>
                                        <th>Nombre</th>
                                        <th width="20px">Acción</th>
                                    </tr>
                                </thead>
                                <tbody id="contenedorFilasActores">
                                    <tr class="odd">
                                        <td colspan="3">No hay registros</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <button type="submit" class="btn btn-success pull-left">Registrar video</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<br><br>


<?php require RUTA.'/vistas/inc/footer.php';?>

<script src="<?php echo RUTA_URL;?>/public/js/agregarFilas.js"></script>

</body>
</html>
