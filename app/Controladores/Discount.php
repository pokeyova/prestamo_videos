<?php
require_once 'Controlador.php';

class Discount extends Controlador{

    public function __construct(){
        $this->descuento = $this->modelo('MDiscount');
    }

    public function index(){
        $descuentos = $this->descuento->lista();
        $this->vista('descuentos/index',[
                                    'request' => 'discount',
                                    'descuentos' => $descuentos,
                                ]);
    }

}