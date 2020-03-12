<?php require RUTA.'/vistas/inc/header.php';?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
           <h3 class="titulo_form">VIDEOS</h3>
        </div>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="titulo_panel">3 primeras películas con mayor duración. Género DRAMA</h2>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4" style="padding:10px;">
                            <div class="contenedor_info" style="border:solid 1px gray; padding:7px;">
                                <h4 class="subrrayado">Peliculas con mayor duración (DRAMA)</h4>
                                <?php if(count($datos['videos']) > 0): ?>
                                <ol>
                                <?php foreach($datos['videos'] as $video):?>
                                <li><?php echo $video->title.' - '.$video->duration.' minutos'; ?></li>
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
