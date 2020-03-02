<?php
require_once 'Controlador.php';

class Video extends Controlador{

    public function __construct(){
        $this->video = $this->modelo('MVideo');
        $this->alternativo = $this->modelo('MAlternativo');
        $this->nominacion = $this->modelo('MNominacion');
        $this->actor = $this->modelo('MActor');
        $this->genero = $this->modelo('MGenre');
        $this->costo = $this->modelo('MCost');
    }

    public function index(){
        $videos = $this->video->lista();
        $this->vista('videos/index',[
                                    'request' => 'video',
                                    'videos' => $videos,
                                ]);
    }

    public function create(){
        $codigo = '';
        $ultimo_video = $this->video->ultimoRegistro();
     
        if($ultimo_video)
        {
            $codigo = (int)(substr($ultimo_video->cod_video,1,strlen($ultimo_video->cod_video)));
            $codigo = $codigo + 1;
            if($codigo < 10)
            {
                $codigo = 'V00'.$codigo;
            }
            elseif($codigo < 100){
                $codigo = 'V0'.$codigo;
            }
            else{
                $codigo = 'V'.$codigo;
            }
        }
        else{
            $codigo = 'V001';
        }

        $generos = $this->genero->lista();
        $costos = $this->costo->lista();

        $this->vista('videos/create',[
            'request' => 'video',
            'codigo' => $codigo,
            'generos' => $generos,
            'costos' => $costos,
        ]);
    }

    public function store(){
        $request = [];
        if(isset($_REQUEST))
        {
            $request = $_REQUEST;
        }

        $respuesta = $this->video->registrarVideo($request);
        if($respuesta)
        {
            header('location:sisvideo/video?bien');
        }
        else{
            header('location:sisvideo/video/create?error');
        }
    }

    public function edit($id){
        $video = $this->video->video($id);
        $nominaciones = $this->nominacion->nominacionesVideo($id);
        $alternativos = $this->alternativo->alternativosVideo($id);
        $actores = $this->actor->actoresVideo($id);

        $generos = $this->genero->lista();
        $costos = $this->costo->lista();

        $this->vista('videos/edit',[
            'request' => 'video',
            'video' => $video,
            'nominaciones' => $nominaciones,
            'alternativos' => $alternativos,
            'actores' => $actores,
            'generos' => $generos,
            'costos' => $costos,
        ]);
    }

    public function update($id){
        $request = [];
        if(isset($_REQUEST))
        {
            $request = $_REQUEST;
        }

        $respuesta = $this->video->actualizarVideo($request,$id);
        if($respuesta)
        {
            header('location:/sisvideo/video?modificado');
        }
        else{
            header('location:/sisvideo/video/edit/'.$id.'?error');
        }
    }

    public function destroy($id){
        $respuesta = $this->video->actualizarStatus($id,0);
        if($respuesta)
        {
            header('location:/sisvideo/video?eliminado');
        }
        else{
            header('location:/sisvideo/video/?error');
        }
    }
}