<?php

/* ************************************
    DATOS PARA LA CONEXIÓN A LA BD 
**************************************/
define("DB_HOST", "127.0.0.1");
define("DB_USER", "root");
define("DB_NAME", "sisvideo_db");
define("DB_PASS", "");
define("DB_OPTIONS",[PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]);


/* ************************************
        NOMBRE DE LA APLICACION 
**************************************/
define("APP_NAME", "sisvideo");

/* ************************************
        URL's DE LA APLICAION 
**************************************/
$http = "http";// definir si es http ó https
define('RUTA_URL', $http.'://'.$_SERVER["HTTP_HOST"].'/'.APP_NAME);
define('VISTAS', RUTA_URL.'app/vistas');

/* ************************************
        RUTA FISICA DE LA APLICACION 
**************************************/
define("RUTA", dirname(dirname(__FILE__)));

?>


