<li class="<?php if(strpos('borrowing',$datos['request']) > -1) echo 'active';else echo ''; ?>">
    <a href="<?php echo RUTA_URL.'/borrowing';?>">PRESTAMOS</a>
</li>
<li class="<?php if(strpos('video',$datos['request']) > -1) echo 'active';else echo '';?>">
    <a href="<?php echo RUTA_URL.'/video';?>">VIDEOS</a>
</li>
<li class="<?php if(strpos('client',$datos['request']) > -1) echo 'active';else echo '';?>">
    <a href="<?php echo RUTA_URL.'/client';?>">CLIENTES</a>
</li>
<li class="<?php if(strpos('genre',$datos['request']) > -1) echo 'active';else echo '';?>">
    <a href="<?php echo RUTA_URL.'/genre';?>">GÉNEROS</a>
</li>