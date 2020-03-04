<?php require RUTA.'/vistas/inc/header.php';?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
           <h3 class="titulo_form">PERSONAL</h3>
        </div>
        
        <form action="<?php echo '/sisvideo/personal/update/'.$datos['personal']->cod_personal;?>" method="post">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="titulo_panel">EDITAR PERSONAL</h2>
                    </div>
                    
                </div>
            </div>
        </form>
    </div>
</div>


