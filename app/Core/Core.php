<?php
class Core{
    // Valores iniciales
    protected $controladorActual = 'login';
    protected $metodoActual = 'index';
    protected $parametros = [];

    // Constructor de la clase Core
    public function __construct(){
        $url = $this->getUrl();

        // Verificar en controladores si el archivo con el nombre del controlador existe
        if(file_exists('../app/Controladores/'. ucwords($url[0]) .'.php')){
            // Si existe se setea como controlador porm defecto
            $this->controladorActual = ucwords($url[0]);

            // unset del indice 0, para desmontar el controlador
            unset($url[0]);
        }

        // requerir el controlador
        require_once '../app/controladores/'. $this->controladorActual .'.php';
        $this->controladorActual = new $this->controladorActual;

        // Verificar la segunda parte de la url, el MÉTODO
        if(isset($url[1])){
            if(method_exists($this->controladorActual, $url[1])){
                // Chequeamos el método
                $this->metodoActual = $url[1];
                unset($url[1]);
            }
        }
        // echo para probar el método actual
        // echo $this->metodoActual;

        // obtener los parámetros
        $this->parametros = $url ? array_values($url) : [];

        // llamar callback con parámetros array
        call_user_func_array([$this->controladorActual,$this->metodoActual], $this->parametros);
    }

    public function getUrl(){
        // echo $_GET['url'];
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}
