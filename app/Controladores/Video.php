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

    
}