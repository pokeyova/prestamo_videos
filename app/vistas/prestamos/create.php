<?php require RUTA.'/vistas/inc/header.php';?>

<?php $m_video = new MVideo(); ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
           <h3 class="titulo_form" style="margin-top:-20px">PRÉSTAMOS</h3>
        </div>
        <div class="col-md-12">
            <h4 class="centreado grueso"style="margin-top:-20px">NUEVO PRÉSTAMO</h4>
        </div>
        <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="input-group">
                    <span class="input-group-addon" style="background:white;font-weight:bold;">Cliente:</span>
                    <select name="cliente" id="cliente" class="form-control buscador" required>
                        <option value="" disabled selected>Seleccione</option>
                    <?php foreach ($datos['clientes'] as $key => $cliente): ?>
                        <option value="<?php echo $cliente->cod_client?>"><?php echo $cliente->name.' '.$cliente->last_name;?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
        </div>
        <!-- LISTA DE VIDEOS -->
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading contenedor_buscador">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="titulo_panel">VIDEOS</h2>
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" id="titulo" placeholder="Título" class="form-control buscador">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" id="actor" placeholder="Actor" class="form-control buscador">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" id="nominacion" placeholder="Nominación" class="form-control buscador">
                        </div>
                        <div class="form-group col-md-6">
                            <select name="genero_nom" id="genero_nom" class="form-control buscador" required>
                                <option value="" selected>Género</option>
                            <?php foreach ($datos['generos'] as $key => $genero): ?>
                                <option value="<?php echo $genero->name?>"><?php echo $genero->name;?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="panel-body contenedor_videos">

                    <table class="table table-bordered table-hover data-table">
                        <thead>
                            <tr>
                                <th width="5%">Nº</th>
                                <th>Título</th>
                                <th class="oculto">Alternativos</th>
                                <th class="oculto">Actores</th>
                                <th class="oculto">Nominaciones</th>
                                <th width="25%">Género</th>
                                <th width="5%">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="lista_videos">
                            <?php foreach($datos['videos'] as $video): ?>
                            <tr class="fila" data-cod = "<?php echo $video->cod_video;?>">
                                <td>#</td>
                                <td><?php echo $video->title;?></td>
                                <td class="alternativos oculto"><?php echo $datos['array_alternativos'][$video->cod_video];?></td>
                                <td class="actores oculto"><?php echo $datos['array_actores'][$video->cod_video];?></td>
                                <td class="nominaciones oculto"><?php echo $datos['array_nominaciones'][$video->cod_video];?></td>
                                <td><?php echo $video->genero;?></td>
                                <td class="btns-opciones">
                                    <a href="#" class="ir-evaluacion agregar"><i class="fa fa-plus" data-toggle="tooltip" data-placement="left" title="Agregar"></i></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <tr class="sin_registros oculto">
                                <td colspan="4">NO HAY REGISTROS</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- AGREGADOS -->
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="titulo_panel">LISTA</h2>
                </div>
                <div class="panel-body">
                <table class="table table-bordered table-hover data-table">
                        <thead>
                            <tr>
                                <th width="5%">Nº</th>
                                <th>Título</th>
                                <th class="oculto">Precio unitario</th>
                                <th class="oculto">Cantidad</th>
                                <th class="oculto">Total(Bs.)</th>
                                <th width="5%">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="lista_prestamos">
                            <tr class="sin_registros">
                                <td colspan="6">NO HAY REGISTROS</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br>

<?php require RUTA.'/vistas/modal/agregar.php';?>

<?php require RUTA.'/vistas/inc/footer.php';?>

<script src="<?php echo RUTA_URL;?>/public/js/prestamos.js"></script>
