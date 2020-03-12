<?php require RUTA.'/vistas/inc/header.php';?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
           <h3 class="titulo_form">PERSONAL</h3>
        </div>
        
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="<?php echo RUTA_URL.'/personal/create';?>" class="btn btn-sm btn-success pull-right">
                        <span>Nuevo registro</span> <i class="fa fa-plus"></i>
                    </a>
                    <h2 class="titulo_panel">LISTA DEL PERSONAL</h2>
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
                                <th>Código</th>
                                <th>Usuario</th>
                                <th>Nombre</th>
                                <th>C.I.</th>
                                <th>Correo</th>
                                <th>Teléfono</th>
                                <th>Tipo</th>
                                <th>Opción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $contador = 1;
                            ?>
                            <?php foreach($datos['personals'] as $personal): ?>
                            <tr>
                                <td><?php echo $contador++;?></td>
                                <td><?php echo $personal->usuario;?></td>
                                <td><?php echo $personal->name.' '.$personal->last_name;?></td>
                                <td><?php echo $personal->ci.' '.$personal->issued;?></td>
                                <td><?php echo $personal->email;?></td>
                                <td><?php echo $personal->phone;?></td>
                                <td><?php echo $personal->tipo;?></td>
                                <td class="btns-opciones">
                                    <!-- <a href="#" class="evaluar"><i class="fa fa-eye" data-toggle="tooltip" data-placement="left" title="Ver"></i></a> -->

                                    <a href="<?php echo RUTA_URL.'/personal/edit/'.$personal->cod_personal;?>" class="modificar"><i class="fa fa-edit" data-toggle="tooltip" data-placement="left" title="Modificar"></i></a>

                                    <a href="" data-url="<?php echo RUTA_URL.'/personal/destroy/'.$personal->cod_personal;?>" data-toggle="modal" data-target="#modal-eliminar" class="eliminar"><i class="fa fa-trash" data-toggle="tooltip" data-placement="left" title="Eliminar"></i></a>
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

<?php require RUTA.'/vistas/inc/footer.php';?>

<script type="text/javascript">
    $(function () {
    $('.data-table').DataTable({
          responsive: true,
          "order": [[ 0, "asc" ]],
          "columns": [
                    { "width": "2%" },
                    { "width": "5%" },
                    { "width": "20%" },
                    { "width": "8%" },
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
        let registro = $(this).parents('tr').children('td').eq(2).text();
        $('#mensajeEliminar').html(`¿Está seguro(a) de eliminar el registro de <b>${registro}</b>?`);
        let url = $(this).attr('data-url');
        $('#formEliminar').prop('action',url);
    });

    $('#btnEliminar').click(function(){
        $('#formEliminar').submit();
    });

</script>

</body>
</html>
