<?php
require_once 'Controlador.php';

class Cost extends Controlador{

    public function __construct(){
        $this->costo = $this->modelo('MCost');
    }

    public function index(){
        $costos = $this->costo->lista();
        $this->vista('costos/index',[
                                    'request' => 'cost',
                                    'costos' => $costos,
                                ]);
    }

}