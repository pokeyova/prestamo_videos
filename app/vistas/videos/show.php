<?php require RUTA.'/vistas/inc/header.php';?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
           <h3 class="titulo_form">VIDEOS</h3>
        </div>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="titulo_panel">VER INFORMACIÓN DE VIDEO</h2>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3" style="padding:10px;">
                            <div class="contenedor_info" style="border:solid 1px gray; padding:7px;">
                                <h4 class="subrrayado">Información</h4>
                                <div class="form-group">
                                    <label>Código:</label> <?php echo $datos['video']->cod_video;?>
                                </div>
                                <div class="form-group">
                                    <label>Título:</label> <?php echo $datos['video']->title;?>
                                </div>
                                <div class="form-group">
                                    <label>Año de publicación:</label> <?php echo $datos['video']->year_publication;?>
                                </div>
                                <div class="form-group">
                                    <label>Género:</label> <?php echo $this->genero->genre($datos['video']->genre_id)->name;?>
                                </div>
                                <div class="form-group">
                                    <label>Costo unitario (Bs.):</label> <?php echo $this->costo->costo($datos['video']->cod_cost)->unit_cost;?>
                                </div>
                                <div class="form-group">
                                    <label>Unidades adquiridas:</label> <?php echo $datos['video']->quantity.' unidades';?>
                                </div>
                                <div class="form-group">
                                    <label>Stock disponible:</label> <?php echo $datos['video']->stock.' unidades';?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3" style="padding:10px;">
                            <div class="contenedor_info" style="border:solid 1px gray; padding:7px;">
                                <h4 class="subrrayado">Títulos alternativos</h4>
                                <?php if(count($datos['alternativos']) > 0): ?>
                                <ol>
                                <?php foreach($datos['alternativos'] as $alternativo):?>
                                <li><?php echo $alternativo->title; ?></li>
                                <?php endforeach;?>
                                </ol>
                                <?php else : ?>
                                No hay registros
                                <?php endif;?>
                            </div>
                        </div>

                        <div class="col-md-3" style="padding:10px;">
                            <div class="contenedor_info" style="border:solid 1px gray; padding:7px;">
                                <h4 class="subrrayado">Nominaciones</h4>
                                <?php if(count($datos['nominaciones']) > 0): ?>
                                <ol>
                                <?php foreach($datos['nominaciones'] as $nominacion):?>
                                <li><?php echo $nominacion->tipo; ?> </li>
                                <?php endforeach;?>
                                </ol>
                                <?php else : ?>
                                No hay registros
                                <?php endif;?>
                            </div>
                        </div>

                        <div class="col-md-3" style="padding:10px;">
                            <div class="contenedor_info" style="border:solid 1px gray; padding:7px;">
                                <h4 class="subrrayado">Actores principales</h4>
                                <?php if(count($datos['actores']) > 0): ?>
                                <ol>
                                <?php foreach($datos['actores'] as $actor):?>
                                <li><?php echo $actor->name; ?> </li>
                                <?php endforeach;?>
                                </ol>
                                <?php else : ?>
                                No hay registros
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                  
                </div>
            </div>
        </div>
    </div>
</div>

<?php require RUTA.'/vistas/inc/footer.php';?>

</body>
</html>
