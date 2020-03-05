<?php
require_once 'Controlador.php';

class Borrowing extends Controlador{

    public function __construct(){
        $this->prestamo = $this->modelo('MBorrowing');
        $this->video = $this->modelo('MVideo');
        $this->genero = $this->modelo('MGenre');
        $this->client = $this->modelo('MClient');
    }

    public function index(){
        $prestamos = $this->prestamo->lista(); 
        $this->vista('prestamos/index',[
                                    'request' => 'borrowing',
                                    'prestamos' => $prestamos,
                    ]);
    }

    public function create(){
        $videos = $this->video->listaOrdenada('ASC','title'); 
        $generos = $this->genero->lista(); 
        $clientes = $this->client->lista(); 

        // armar los titulos alternativos
        $array_alternativos = [];
        $array_actores = [];
        $array_nominaciones = [];
        foreach($videos as $video)
        {
            $alternativos = $this->video->alternativosTitle($video->cod_video);
            $array_alternativos[$video->cod_video] = '';
            if(count($alternativos) > 0)
            {
                foreach($alternativos as $alternativo)
                {
                    $array_alternativos[$video->cod_video] .= $alternativo->title.' ';
                }
            }

}