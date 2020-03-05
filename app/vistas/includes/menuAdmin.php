<li class="<?php if(strpos('borrowing',$datos['request']) > -1) echo 'active';else echo ''; ?>">
    <a href="<?php echo RUTA_URL.'/borrowing';?>">PRESTAMOS</a>
</li>
<li class="<?php if(strpos('video',$datos['request']) > -1) echo 'active';else echo '';?>">
    <a href="<?php echo RUTA_URL.'/video';?>">VIDEOS</a>
</li>
<li class="<?php if(strpos('client',$datos['request']) > -1) echo 'active';else echo '';?>">
    <a href="<?php echo RUTA_URL.'/client';?>">CLIENTES</a>
</li>
<li class="<?php if(strpos('cost',$datos['request']) > -1) echo 'active';else echo '';?>">
    <a href="<?php echo RUTA_URL.'/cost';?>">COSTOS</a>
</li>
<li class="<?php if(strpos('discount',$datos['request']) > -1) echo 'active';else echo '';?>">
    <a href="<?php echo RUTA_URL.'/discount';?>">DESCUENTOS</a>
</li>
<li class="<?php if(strpos('audit',$datos['request']) > -1) echo 'active';else echo '';?>">
    <a href="<?php echo RUTA_URL.'/audit';?>">AUDITORIA</a>
</li>
<li class="<?php if(strpos('personal',$datos['request']) > -1) echo 'active';else echo '';?>">
    <a href="<?php echo RUTA_URL.'/personal';?>">PERSONAL</a>
</li>
<li class="<?php if(strpos('genre',$datos['request']) > -1) echo 'active';else echo '';?>">
    <a href="<?php echo RUTA_URL.'/genre';?>">GÉNEROS</a>
</li>