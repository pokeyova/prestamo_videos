<?php require RUTA.'/vistas/inc/header.php';?>
<?php $borrowing = new MBorrowing();?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
           <h3 class="titulo_form">PRÉSTAMOS</h3>
        </div>
        
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="<?php echo RUTA_URL.'/borrowing/create';?>" class="btn btn-sm btn-success pull-right">
                        <span>Nuevo préstamo</span> <i class="fa fa-plus"></i>
                    </a>
                    <h2 class="titulo_panel">LISTA DE PRÉSTAMOS</h2>
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
                                <th>Fecha préstamo</th>
                                <th>Código</th>
                                <th>Cliente</th>
                                <th>Fecha devolución</th>
                                <th>Cantidad</th>
                                <th>Total (Bs.)</th>
                                <th>Estado</th>
                                <th>Opción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $contador = 1;
                            ?>
                            <?php foreach($datos['prestamos'] as $prestamo): ?>
                            <tr>
                                <td><?php echo $prestamo->borrow_date;?></td>
                                <td><?php echo $prestamo->cod_borrowing;?></td>
                                <td><?php echo $prestamo->cliente;?></td>
                                <td><?php echo $prestamo->return_date;?></td>
                                <td><?php echo $borrowing->cantidadVideos($prestamo->cod_borrowing)->cantidad;?></td>
                                <td><?php echo $prestamo->status;?></td>
                                <td class="btns-opciones">
                                    <!-- <a href="#" class="evaluar"><i class="fa fa-eye" data-toggle="tooltip" data-placement="left" title="Ver"></i></a> -->

                                    <a href="<?php echo RUTA_URL.'/borrowing/edit/'.$prestamo->cod_borrowing;?>" class="modificar"><i class="fa fa-edit" data-toggle="tooltip" data-placement="left" title="Modificar"></i></a>

                                    <a href="" data-url="<?php echo RUTA_URL.'/borrowing/destroy/'.$prestamo->cod_borrowing;?>" data-toggle="modal" data-target="#modal-eliminar" class="eliminar"><i class="fa fa-trash" data-toggle="tooltip" data-placement="left" title="Eliminar"></i></a>
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
<br><br>

<?php require RUTA.'/vistas/modal/eliminar.php';?>

<?php require RUTA.'/vistas/inc/footer.php';?>

<script type="text/javascript">
    $(function () {
    $('.data-table').DataTable({
          responsive: true,
          "order": [[ 0, "asc" ]],
          "columns": [
                    { "width": "10%" },
                    { "width": "7%" },
                    { "width": "20%" },
                     null,
                     null,
                     null,
                     null,
                    { "width": "17%" },
           ],
           pageLength:25,
           language:lenguaje
      });
    });
</script>
