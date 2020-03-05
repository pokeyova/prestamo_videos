<?php require RUTA.'/vistas/inc/header.php';?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
           <h3 class="titulo_form">DESCUENTOS</h3>
        </div>
        
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="<?php echo RUTA_URL.'/discount/create';?>" class="btn btn-sm btn-success pull-right">
                        <span>Nuevo descuento</span> <i class="fa fa-plus"></i>
                    </a>
                    <h2 class="titulo_panel">LISTA DE DESCUENTOS</h2>
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
                                <th>Nº</th>
                                <th>Código</th>
                                <th>Cantidad</th>
                                <th>Descuento %</th>
                                <th>Opción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $contador = 1;
                            ?>
                            <?php foreach($datos['descuentos'] as $descuento): ?>
                            <tr>
                                <td><?php echo $contador++;?></td>
                                <td><?php echo $descuento->cod_cost;?></td>
                                <td><?php echo $descuento->from.' a '.$descuento->to;?></td>
                                <td><?php echo $descuento->discount;?></td>
                                <td class="btns-opciones">
                                    <!-- <a href="#" class="evaluar"><i class="fa fa-eye" data-toggle="tooltip" data-placement="left" title="Ver"></i></a> -->

                                    <a href="<?php echo RUTA_URL.'/discount/edit/'.$descuento->cod_discount;?>" class="modificar"><i class="fa fa-edit" data-toggle="tooltip" data-placement="left" title="Modificar"></i></a>

                                    <a href="" data-url="<?php echo RUTA_URL.'/discount/destroy/'.$descuento->cod_discount;?>" data-toggle="modal" data-target="#modal-eliminar" class="eliminar"><i class="fa fa-trash" data-toggle="tooltip" data-placement="left" title="Eliminar"></i></a>
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
