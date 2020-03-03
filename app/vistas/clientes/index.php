<?php require RUTA.'/vistas/inc/header.php';?>

<?php 
    $m_client = new MClient();
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
           <h3 class="titulo_form">CLIENTES</h3>
        </div>
        
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="<?php echo RUTA_URL.'/client/create';?>" class="btn btn-sm btn-success pull-right">
                        <span>Nuevo registro</span> <i class="fa fa-plus"></i>
                    </a>
                    <h2 class="titulo_panel">LISTA DE CLIENTES</h2>
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
                    <?php if(isset($_GET['bloqueado'])): ?>
                    <div class="alert alert-success">
                        <button class="close" data-dismiss="alert">&times;</button>
                        Bloqueo realizado con éxito
                    </div>
                    <?php endif; ?>
                    <?php if(isset($_GET['desbloqueado'])): ?>
                    <div class="alert alert-success">
                        <button class="close" data-dismiss="alert">&times;</button>
                        Cliente desbloqueado éxitosamente
                    </div>
                    <?php endif; ?>
                    <table class="table table-bordered table-hover data-table">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Dirección</th>
                                <th>FechaRegistro</th>
                                <th>Estado</th>
                                <th>Opción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $contador = 1;
                            ?>
                            <?php foreach($datos['clientes'] as $cliente): ?>
                            <tr>
                                <td><?php echo $cliente->cod_client;?></td>
                                <td><?php echo $cliente->name.' '.$cliente->last_name;?></td>
                                <td><?php echo $cliente->email;?></td>
                                <td><?php echo $cliente->address;?></td>
                                <td><?php echo $cliente->registration_date;?></td>
                                <td><?php if($m_client->bloqueo($cliente->cod_client)): ?> BLOQUEADO<?php else: ?> ACTIVO<?php endif; ?></td>
                                <td class="btns-opciones">
                                    <a href="#" class="evaluar"><i class="fa fa-eye" data-toggle="tooltip" data-placement="left" title="Ver"></i></a>

                                    <a href="<?php echo RUTA_URL.'/client/edit/'.$cliente->cod_client;?>" class="modificar"><i class="fa fa-edit" data-toggle="tooltip" data-placement="left" title="Modificar"></i></a>

                                    <?php if($m_client->bloqueo($cliente->cod_client)): ?> 
                                        <!-- DESBLOQUEAR -->
                                        <a href="<?php echo RUTA_URL.'/client/desbloquear/'.$m_client->bloqueo($cliente->cod_client)->id;?>" class="ir-evaluacion"><i class="fa fa-key" data-toggle="tooltip" data-placement="left" title="Desbloquear"></i></a>
                                    <?php else: ?>
                                        <!-- BLOQUEAR -->
                                        <a href="#" data-url="<?php echo RUTA_URL.'/client/bloquear/'.$cliente->cod_client;?>" data-toggle="modal" data-target="#modal-bloquear" class="guardar bloquear"><i class="fa fa-user-lock" data-toggle="tooltip" data-placement="left" title="Bloquear cliente"></i></a>
                                    <?php endif; ?>

                                    <a href="" data-url="<?php echo RUTA_URL.'/client/destroy/'.$cliente->cod_client;?>" data-toggle="modal" data-target="#modal-eliminar" class="eliminar"><i class="fa fa-trash" data-toggle="tooltip" data-placement="left" title="Eliminar"></i></a>
                                    
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
<?php require RUTA.'/vistas/modal/bloquear.php';?>

<?php require RUTA.'/vistas/inc/footer.php';?>

<script type="text/javascript">
    $(function () {
        $('.data-table').DataTable({
            responsive: true,
            "order": [[ 0, "asc" ]],
            "columns": [
                { "width": "5%" },
                { "width": "5%" },
                { "width": "20%" },
                null,
                null,
                null,
                { "width": "20%" },
            ],
            pageLength:25,
            language:lenguaje
        });
    });

    // ELIMINAR
    $(document).on('click','table.data-table tbody tr td.btns-opciones a.eliminar',function(e){
        e.preventDefault();
        let registro = $(this).parents('tr').children('td').eq(1).text();
        $('#mensajeEliminar').html(`¿Está seguro(a) de eliminar el registro de <b>${registro}</b>?`);
        let url = $(this).attr('data-url');
        $('#formEliminar').prop('action',url);
    });

    $('#btnEliminar').click(function(){
        $('#formEliminar').submit();
    });

    // BLOQUEAR
    $(document).on('click','table.data-table tbody tr td.btns-opciones a.bloquear',function(e){
        e.preventDefault();
        let registro = $(this).parents('tr').children('td').eq(1).text();
        $('#mensajeBloquear').html(`¿Está seguro(a) de bloquear al cliente <b>${registro}</b>?`);
        let url = $(this).attr('data-url');
        $('#formBloquear').prop('action',url);
    });

    $('#btnBloquear').click(function(){
        if($('#reason').val().trim() !="")
        {
            $('#formBloquear').submit();
        }
        else{
            $('#error-bloqueo').removeClass('oculto');
        }
    });



</body>
</html>