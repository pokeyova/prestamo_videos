<?php
require_once 'Controlador.php';

class User extends Controlador{

    public function __construct(){
        $this->user = $this->modelo('MUser');
    }

    public function index(){
        $this->vista('auth/login',[
                                    'empresa' => 'Empresa',
                    ]);
    }

    public function create(){

    }

    public function store(){
        
    }

    public function edit($id){
        
    }

    public function update($id){
        
    }

    public function destroy($id){
        
    }

    
    public function passwordHash($cadena)
    {
        $hash = password_hash($cadena, PASSWORD_DEFAULT, ["cost" => 10]);
        return $hash;
    }

    public function iniciaUser(){
        // $datos = [
        //     'cod_user' => 'A1',
        //     'name' => 'admin',
        //     'password' => $this->passwordHash('admin'),
        //     'type' => 'ADMINISTRADOR',
        //     'register_date' => date('Y-m-d')
        // ];
        // $this->user->registrarUsuario($datos);

        // return true;
    }
}