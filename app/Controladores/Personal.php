<?php
require_once 'Controlador.php';
require_once RUTA.'/modelos/MPersonal.php';

class Personal extends Controlador{

    public function __construct(){
        $this->personal = $this->modelo('MPersonal');
    }

    public function index(){
        $personals = $this->personal->lista();
        $this->vista('personal/index',[
                                    'request' => 'personal',
                                    'personals' => $personals,
                                ]);
    }

    public function create(){
        $this->vista('personal/create',[
            'request' => 'personal',
        ]);
    }

    public function store(){
        $request = [];
        if(isset($_REQUEST))
        {
            $request = $_REQUEST;
        }

        $respuesta = $this->personal->registrarPersonal($request);
        if($respuesta)
        {
            header('location:sisvideo/personal?bien');
        }
        else{
            header('location:sisvideo/personal/create?error');
        }
    }

    public function edit($id){
        $personal = $this->personal->personal($id);
        $this->vista('personal/edit',[
            'request' => 'personal',
            'personal' => $personal,
        ]);
    }

    public function update($id){
        $request = [];
        if(isset($_REQUEST))
        {
            $request = $_REQUEST;
        }
        $respuesta = $this->personal->actualizarPersonal($request,$id);
        if($respuesta)
        {
            header('location:/sisvideo/personal?modificado');
        }
        else{
            header('location:/sisvideo/personal/edit/'.$id.'?error');
        }
    }

    public function destroy($id){
        $respuesta = $this->personal->actualizarStatus($id,0);
        if($respuesta)
        {
            header('location:/sisvideo/personal?eliminado');
        }
        else{
            header('location:/sisvideo/personal/?error');
        }
    }
}