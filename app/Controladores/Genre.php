<?php
require_once 'Controlador.php';

class Genre extends Controlador{

    public function __construct(){
        $this->genre = $this->modelo('MGenre');
    }

    public function index(){
        $generos = $this->genre->lista();
        $this->vista('generos/index',[
                                    'request' => 'genre',
                                    'generos' => $generos
                                ]);
    }

    
    public function create(){
        $this->vista('generos/create',[
            'request' => 'genre',
        ]);
    }

    public function store(){
        $request = [];
        if(isset($_REQUEST))
        {
            $request = $_REQUEST;
        }

        $respuesta = $this->genre->registrarGenre($request);
        if($respuesta)
        {
            header('location:sisvideo/genre?bien');
        }
        else{
            header('location:sisvideo/genre/create?error');
        }
    }

    public function edit($id){
        $genre = $this->genre->genre($id);
        $this->vista('generos/edit',[
            'request' => 'genre',
            'genre' => $genre,
        ]);
    }

    public function update($id){
        $request = [];
        if(isset($_REQUEST))
        {
            $request = $_REQUEST;
        }
        $respuesta = $this->genre->actualizarGenre($request,$id);
        if($respuesta)
        {
            header('location:/sisvideo/genre?modificado');
        }
        else{
            header('location:/sisvideo/genre/edit/'.$id.'?error');
        }
    }

    public function destroy($id){

        $comprueba = $this->genre->genreVideo($id);
        // COMPROBAR SI HAY VIDEOS USANDO ESTE GÉNERO
        if(count($comprueba) > 0)
        {
            // si existen videos usando este genero
            // no eliminarlo y mandar mensaje de existencia
            header('location:/sisvideo/genre/?existe');
        }
        else{
            // si no hay videos usandolo eliminarlo
            $respuesta = $this->genre->delete($id);
            if($respuesta)
            {
                header('location:/sisvideo/genre?eliminado');
            }
            else{
                header('location:/sisvideo/genre/?error');
            }
        }
    }
}