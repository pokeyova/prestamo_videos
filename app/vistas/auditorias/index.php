<?php require RUTA.'/vistas/inc/header.php';?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
           <h3 class="titulo_form">AUDITORÍA</h3>
        </div>
        
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="titulo_panel">LISTA DE MOVIMIENTOS</h2>
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
                    <?php if(isset($_GET['existe'])): ?>
                    <div class="alert alert-info">
                        <button class="close" data-dismiss="alert">&times;</button>
                        No se puede eliminar el registro porque esta siendo utilizado
                    </div>
                    <?php endif; ?>
                    <table class="table table-bordered table-hover data-table">
                        <thead>
                            <tr>
                                <th>Fecha y hora</th>
                                <th>Realizado por</th>
                                <th>Video</th>
                                <th>Acción realizada</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($datos['auditorias'] as $audit): ?>
                            <tr>
                                <td><?php echo date('d/m/Y H:i', strtotime($audit->date.' '.$audit->time));?></td>
                                <td><?php echo $audit->usuario;?></td>
                                <td><?php echo $audit->video;?></td>
                                <td><?php echo $audit->action;?></td>
                                <td><?php echo $audit->quantity;?></td>
                                <!-- <td class="btns-opciones">
                                    <a href="#" class="evaluar"><i class="fa fa-eye" data-toggle="tooltip" data-placement="left" title="Ver"></i></a>
                                </td> -->
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

<?php require RUTA.'/vistas/inc/footer.php';?>

<script type="text/javascript">
    $(function () {
    $('.data-table').DataTable({
          responsive: true,
          "order": [[ 0, "desc" ]],
          "columns": [
                    { "width": "15%" },
                     null,
                     null,
                     null,
                    { "width": "10%" },
           ],
           pageLength:25,
           language:lenguaje
      });
    });

    // ELIMINAR
    $(document).on('click','table.data-table tbody tr td.btns-opciones a.eliminar',function(e){
        e.preventDefault();
        let registro = $(this).parents('tr').children('td').eq(1).text();
        $('#mensajeEliminar').html(`¿Está seguro(a) de eliminar el género <b>${registro}</b>?`);
        let url = $(this).attr('data-url');
        $('#formEliminar').prop('action',url);
    });

    $('#btnEliminar').click(function(){
        $('#formEliminar').submit();
    });

</script>

</body>
</html>