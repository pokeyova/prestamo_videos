<?php require RUTA.'/vistas/inc/header.php';?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
           <h3 class="titulo_form">VIDEOS</h3>
        </div>
        <?php echo RUTA_URL;?>
        <form action="<?php echo '/sisvideo/video/update/'.$datos['video']->cod_video;?>" method="post">
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
                                    <input type="text" name="cod_video" class="form-control" value="<?php echo $datos['video']->cod_video;?>" required readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Título*:</label>
                                    <input type="text" name="title" class="form-control" value="<?php echo $datos['video']->title;?>" required autofocus>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Duración (minutos)*:</label>
                                    <input type="number" min="1" name="duration" class="form-control" value="<?php echo $datos['video']->duration;?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Año de publicación*:</label>
                                    <input type="number" min="0" name="year_publication" class="form-control" value="<?php echo $datos['video']->year_publication;?>" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Género*:</label>
                                    <select name="genre_id" id="genre_id" class="form-control" required>
                                        <option value="" disabled selected>Seleccione</option>
                                    <?php foreach ($datos['generos'] as $key => $genero): ?>
                                        <?php if($genero->id == $datos['video']->genre_id): ?>
                                            <option value="<?php echo $genero->id?>" selected><?php echo $genero->name;?></option>
                                        <?php else : ?>
                                            <option value="<?php echo $genero->id?>"><?php echo $genero->name;?></option>
                                        <?php endif; ?>
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
                                        <?php if($costo->cod_cost == $datos['video']->cod_cost): ?>
                                        <option value="<?php echo $costo->cod_cost?>" selected><?php echo $costo->cod_cost.' - '.$costo->unit_cost.' Bs.';?></option>
                                        <?php else : ?>
                                            <option value="<?php echo $costo->cod_cost?>"><?php echo $costo->cod_cost.' - '.$costo->unit_cost.' Bs.';?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Unidades adquiridas*:</label>
                                    <input type="number" min="0" value="<?php echo $datos['video']->quantity;?>" name="quantity" class="form-control" value="" required>
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
                                    <?php if(count($datos['alternativos']) > 0): ?>
                                    <?php foreach($datos['alternativos'] as $alternativo):?>
                                    <tr class="fila">
                                        <td>#</td>
                                        <td><?php echo $alternativo->title; ?> <input type="hidden" name="existeAlternativo[]" value="<?php echo $alternativo->id; ?>"></td>
                                        <td class="quitar"><span class="eliminar" title="Eliminar"><i class="fa fa-times"></i></span></td>
                                    </tr>
                                    <?php endforeach;?>
                                    <?php else : ?>
                                    <tr class="odd">
                                        <td colspan="3">No hay registros</td>
                                    </tr>
                                    <?php endif;?>
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
                                    <?php if(count($datos['nominaciones']) > 0): ?>
                                    <?php foreach($datos['nominaciones'] as $nominacion):?>
                                    <tr class="fila">
                                        <td>#</td>
                                        <td><?php echo $nominacion->tipo; ?> <input type="hidden" name="existeNominacion[]" value="<?php echo $nominacion->id; ?>"></td>
                                        <td><?php echo $nominacion->won; ?> <input type="hidden" name=""></td>
                                        <td class="quitar"><span class="eliminar" title="Eliminar"><i class="fa fa-times"></i></span></td>
                                    </tr>
                                    <?php endforeach;?>
                                    <?php else : ?>
                                    <tr class="odd">
                                        <td colspan="4">No hay registros</td>
                                    </tr>
                                    <?php endif;?>
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
                                <?php if(count($datos['actores']) > 0): ?>
                                    <?php foreach($datos['actores'] as $actor):?>
                                    <tr class="fila">
                                        <td>#</td>
                                        <td><?php echo $actor->name; ?> <input type="hidden" name="existeActor[]" value="<?php echo $actor->id; ?>"></td>
                                        <td class="quitar"><span class="eliminar" title="Eliminar"><i class="fa fa-times"></i></span></td>
                                    </tr>
                                    <?php endforeach;?>
                                    <?php else : ?>
                                    <tr class="odd">
                                        <td colspan="3">No hay registros</td>
                                    </tr>
                                    <?php endif;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <button type="submit" class="btn btn-success pull-left">Actualizar video</button>
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
