<?php
require_once 'Controlador.php';

class Client extends Controlador{

    public function __construct(){
        $this->client = $this->modelo('MClient');
        $this->bloqueo = $this->modelo('MClientLocked');
    }

    public function index(){
        $clientes = $this->client->lista();
        $this->vista('clientes/index',[
                                    'request' => 'client',
                                    'clientes' => $clientes,
                                ]);
    }

    public function create(){
        $this->vista('clientes/create',[
            'request' => 'client',
        ]);
    }

    public function store(){
        $request = [];
        if(isset($_REQUEST))
        {
            $request = $_REQUEST;
        }
        $request['registration_date'] = date('Y-m-d');
        $respuesta = $this->client->registrarCliente($request);
        if($respuesta)
        {
            header('location:sisvideo/client?bien');
        }
        else{
            header('location:sisvideo/client/create?error');
        }
    }

    public function edit($id){
        $cliente = $this->client->cliente($id);
        $this->vista('clientes/edit',[
            'request' => 'client',
            'cliente' => $cliente,
        ]);
    }

    public function update($id){
        $request = [];
        if(isset($_REQUEST))
        {
            $request = $_REQUEST;
        }
        $respuesta = $this->client->actualizarCliente($request,$id);
        if($respuesta)
        {
            header('location:/sisvideo/client?modificado');
        }
        else{
            header('location:/sisvideo/client/edit/'.$id.'?error');
        }
    }

    public function bloquear($id)
    {
        $request = [];
        if(isset($_REQUEST))
        {
            $request = $_REQUEST;
        }
        $request['cod_client'] = $id;
        $request['register_date'] = date('Y-m-d H:i:s');
        $respuesta = $this->bloqueo->registrarBloqueo($request);
        if($respuesta)
        {
            header('location:/sisvideo/client?bloqueado');
        }
        else{
            header('location:/sisvideo/client?error');
        }
    }


}