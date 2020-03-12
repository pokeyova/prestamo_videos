<?php require RUTA.'/vistas/inc/header.php';?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
           <h3 class="titulo_form">VIDEOS</h3>
        </div>
        
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="<?php echo RUTA_URL.'/video/masAlquiladosPocoStock';?>" class="btn btn-sm btn-warning pull-right" style="border-radius:0px!important;"><span>Mas alquilados con poco stock </span> <i class="fa fa-clock"></i></a>
                    
                    <a href="<?php echo RUTA_URL.'/video/mayorDuracionDrama';?>" class="btn btn-sm btn-info pull-right" style="border-radius:0px!important;"><span>Mayor duración DRAMA</span> <i class="fa fa-clock"></i></a>

                    <a href="<?php echo RUTA_URL.'/video/create';?>" class="btn btn-sm btn-success pull-right" style="border-radius:0px!important;"><span>Nuevo video</span> <i class="fa fa-plus"></i></a>
                    <h2 class="titulo_panel">LISTA DE VIDEOS</h2>
                </div>
                <div class="panel-body">
                    <?php if(isset($_GET['bien'])): ?>
                    <div class="alert alert-success">
                        <button class="close" data-dismiss="alert">&times;</button>
                        Registro guardado con éxito
                    </div>
                    <?php endif; ?>
                    <?php if(isset($_GET['modificado'])): ?>
                    <div class="alert alert-success">
                        <button class="close" data-dismiss="alert">&times;</button>
                        Modificación éxitosa
                    </div>
                    <?php endif; ?>
                    <?php if(isset($_GET['eliminado'])): ?>
                    <div class="alert alert-success">
                        <button class="close" data-dismiss="alert">&times;</button>
                        Registro eliminado con éxito
                    </div>
                    <?php endif; ?>
                    <?php if(isset($_GET['error'])): ?>
                    <div class="alert alert-warning">
                        <button class="close" data-dismiss="alert">&times;</button>
                        Algo salió mal intente nuevamente
                    </div>
                    <?php endif; ?>

                    <table class="table table-bordered table-hover data-table">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Título</th>
                                <th>Duración</th>
                                <th>Año publicación</th>
                                <th>Disponibles</th>
                                <th>Género</th>
                                <th>Costo Bs.</th>
                                <th>Opción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($datos['videos'] as $video): ?>
                            <tr>
                                <td>
                                    <?php echo $video->cod_video;?>
                                </td>
                                <td>
                                    <?php echo $video->title;?>
                                </td>
                                <td>
                                    <?php echo $video->duration;?>
                                </td>
                                <td>
                                    <?php echo $video->year_publication;?>
                                </td>
                                <td>
                                    <?php echo $video->stock;?>
                                </td>
                                <td>
                                    <?php echo $video->genero;?>
                                </td>
                                <td>
                                    <?php echo $video->costo;?>
                                </td>
                                <td class="btns-opciones">
                                    <a href="#" data-url="<?php echo '/'.APP_NAME.'/video/copias/'.$video->cod_video;?>" data-toggle="modal" data-target="#modal-copias" class="ir-evaluacion copias"><i class="fa fa-plus-circle" data-toggle="tooltip" data-placement="left" title="Nuevas Copias"></i></a>
                                  
                                    <a href="#" data-url="<?php echo '/'.APP_NAME.'/video/bajas/'.$video->cod_video;?>" data-toggle="modal" data-target="#modal-bajas" class="eliminar bajas"><i class="fa fa-minus" data-toggle="tooltip" data-placement="left" title="Registrar bajas"></i></a>

                                    <a href="<?php echo '/'.APP_NAME.'/video/show/'.$video->cod_video;?>" class="evaluar"><i class="fa fa-eye" data-toggle="tooltip" data-placement="left" title="Ver"></i></a>
                                    
                                    <a href="<?php echo RUTA_URL.'/video/edit/'.$video->cod_video;?>" class="modificar"><i class="fa fa-edit" data-toggle="tooltip" data-placement="left" title="Modificar"></i></a>

                                    <a href="" data-url="<?php echo RUTA_URL.'/video/destroy/'.$video->cod_video;?>" data-toggle="modal" data-target="#modal-eliminar" class="eliminar"><i class="fa fa-trash" data-toggle="tooltip" data-placement="left" title="Eliminar"></i></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
<br>

<?php require RUTA.'/vistas/modal/eliminar.php';?>
<?php require RUTA.'/vistas/modal/copias.php';?>
<?php require RUTA.'/vistas/modal/bajas.php';?>

<?php require RUTA.'/vistas/inc/footer.php';?>

<script type="text/javascript">
    $(function () {
    $('.data-table').DataTable({
          responsive: true,
          "order": [[ 0, "asc" ]],
          "columns": [
                    { "width": "8%" },
                     null,
                    { "width": "5%" },
                    { "width": "5%" },
                    { "width": "5%" },
                     null,
                    { "width": "10%" },
                    { "width": "22%" },
           ],
           pageLength:25,
           language:lenguaje
      });
    });

    // ELIMINAR
    $(document).on('click','table.data-table tbody tr td.btns-opciones a.eliminar',function(e){
        e.preventDefault();
        let registro = $(this).parents('tr').children('td').eq(1).text();
        $('#mensajeEliminar').html(`¿Está seguro(a) de eliminar el video <b>${registro}</b>?`);
        let url = $(this).attr('data-url');
        $('#formEliminar').prop('action',url);
    });

    $('#btnEliminar').click(function(){
        $('#formEliminar').submit();
    });

    // COPIAS
    $(document).on('click','table.data-table tbody tr td.btns-opciones a.copias',function(e){
        e.preventDefault();
        let registro = $(this).parents('tr').children('td').eq(1).text();
        $('#title_pelicula').html(`${registro}`);
        let url = $(this).attr('data-url');
        $('#formNuevasCopias').prop('action',url);
    });

    $('#btnRegistrarCopias').click(function(){
        if($('#formNuevasCopias input[name="cantidad"]').val() != '' && $('#formNuevasCopias input[name="cantidad"]').val() > 0)
        {
            $('#formNuevasCopias .error-cantidad').addClass('oculto');
            $('#formNuevasCopias').submit();
        }
        else{
            $('#formNuevasCopias .error-cantidad').removeClass('oculto');
        }
    });

    // BAJAS
    $(document).on('click','table.data-table tbody tr td.btns-opciones a.bajas',function(e){
        e.preventDefault();
        let registro = $(this).parents('tr').children('td').eq(1).text();
        $('#title_pelicula_bajas').html(`${registro}`);
        let url = $(this).attr('data-url');
        $('#formNuevasBajas').prop('action',url);
    });

    $('#btnRegistrarBajas').click(function(){
        if($('#formNuevasBajas input[name="cantidad"]').val() != '' && $('#formNuevasBajas input[name="cantidad"]').val() > 0)
        {
            $('#formNuevasBajas .error-cantidad').addClass('oculto');
            if($('#formNuevasBajas textarea[name="reason"]').val() != '')
            {
                $('#formNuevasBajas .error-razon').addClass('oculto');
                $('#formNuevasBajas').submit();
            }
            else{
                $('#formNuevasBajas .error-razon').removeClass('oculto');
            }
        }
        else{
            $('#formNuevasBajas .error-cantidad').removeClass('oculto');
        }
    });


</script>

</body>
</html>