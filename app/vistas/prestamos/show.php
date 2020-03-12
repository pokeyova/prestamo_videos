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
                    <h2 class="titulo_panel">VER PRÉSTAMO</h2>
                </div>
                <div class="panel-body" style="padding: 60px 60px 60px 100px;">
                    <?php if(isset($_GET['bien'])): ?>
                    <div class="alert alert-success">
                        <button class="close" data-dismiss="alert">&times;</button>
                        Registro guardado con éxito
                    </div>
                    <?php endif; ?>
                   
                    <?php if(isset($_GET['error'])): ?>
                    <div class="alert alert-warning">
                        <button class="close" data-dismiss="alert">&times;</button>
                        Algo salió mal intente nuevamente
                    </div>
                    <?php endif; ?>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <img src="<?php echo RUTA_URL; ?>/public/imgs/logo.jpg" class="logo_factura" alt="">
                            <div class="titulo">
                                <h2><?php echo $datos['empresa'];?></h2>
                                <p class="dir">La Paz-Bolivia, Zona los olivos calle los heroes #32</p>
                            </div>

                            <div class="titulo_derecha">
                                <h2>Factura</h2>
                                <div class="contenedor_info">
                                    <p class="info"><strong>NIT: </strong><span>1000150052</span></p>
                                    <p class="info"><strong>FACTURA N°: </strong><span><?php echo $datos['factura']->cod_invoice;?></span></p>
                                    <p class="info"><strong>AUTORIZACIÓN: </strong><span>10002134567</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="datos_factura">
                                <div class="facturar_a">
                                    <p><strong>Cliente: </strong> <?php echo $datos['prestamo']->cliente?></p>
                                    <p><strong>NIT/C.I.: </strong> <?php echo $datos['prestamo']->nit?></p>
                                </div>
                                <div class="num_fac">
                                    <p><strong>Fecha: </strong> <?php echo date('d/m/Y',strtotime($datos['prestamo']->borrow_date));?></p>
                                    <p><strong>Fecha devolución: </strong> <?php echo date('d/m/Y',strtotime($datos['prestamo']->return_date));?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="factura">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>PRODUCTO</th>
                                        <th>P/U.(Bs.)</th>
                                        <th>CANTIDAD</th>
                                        <th>SUBTOTAL (Bs.)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $cont = 1;   
                                    ?>
                                    <?php foreach($datos['detalle_factura'] as $detalle):?>
                                        <tr>
                                            <td><?php echo $cont++;?></td>
                                            <td><?php echo $detalle->title;?></td>
                                            <td><?php echo $detalle->unit_cost;?></td>
                                            <td><?php echo $detalle->quantity;?></td>
                                            <td><?php echo $detalle->total;?></td>
                                        </tr>
                                    <?php endforeach; ?>

                                    <tr class="total_final">
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>
                                            TOTAL (Bs.)
                                        </td>
                                        <td>
                                            <?php echo $datos['factura']->total;?>
                                        </td>
                                    </tr>
                                    <tr class="total_final">
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>
                                            DESCUENTO %
                                        </td>
                                        <td>
                                            <?php echo $datos['descuento'];?>
                                        </td>
                                    </tr>
                                    <tr class="total_final">
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>
                                            TOTAL FINAL (Bs.)
                                        </td>
                                        <td>
                                            <?php echo $datos['factura']->end_total;?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>                  
                        </div>                            
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="info1">
                                "ESTA FACTURA CONTRIBUYE AL DESARROLLO DEL PAÍS EL USO ILÍCITO DE ÉSTA SERA SANCIONADO A LEY"
                            </div>
                            <div class="info2">
                                Ley Nº 453: El proveedor debe exhibir certificaciones de habilitación o documentos que acrediten las capacidades u ofertas de servicios.
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="<?php echo RUTA_URL.'/borrowing/imprimir/'.$datos['prestamo']->cod_borrowing;?>" target="_blank" class="btn btn-success">
                                <i class="fa fa-print"></i>
                                <span>Imprimir</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>                    
        </div>
    </div>
</div>
<br><br>


<?php require RUTA.'/vistas/inc/footer.php';?>


