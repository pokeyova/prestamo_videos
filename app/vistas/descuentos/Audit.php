<?php
require_once 'Controlador.php';

class Audit extends Controlador{

    public function __construct(){
        $this->audit = $this->modelo('MAudit');
    }

    public function index(){
        $auditorias = $this->audit->lista();
        $this->vista('auditorias/index',[
                                    'request' => 'audit',
                                    'auditorias' => $auditorias,
                                ]);
    }

}