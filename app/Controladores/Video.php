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
        $this->audit = $this->modelo('MAudit');
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
        if($respuesta['resp'])
        {
            // si registra el video registrar en la tabla audit
            session_start();
            $this->audit->registrarAuditoria([
                'cod_user'=> $_SESSION['cod_user'],
                'cod_video'=> $respuesta['cod_video'],
                'action'=> 'REGISTRO',
                'quantity'=> $request['quantity'],
                'date'=> date('Y-m-d'),
                'time'=> date('H:i:s')
            ]);
            header('location:sisvideo/video?bien');
        }
        else{
            header('location:sisvideo/video/create?error');
        }
    }

    public function show($id){
        $video = $this->video->video($id);
        $nominaciones = $this->nominacion->nominacionesVideo($id);
        $alternativos = $this->alternativo->alternativosVideo($id);
        $actores = $this->actor->actoresVideo($id);

        $generos = $this->genero->lista();
        $costos = $this->costo->lista();

        $this->vista('videos/show',[
            'request' => 'video',
            'video' => $video,
            'nominaciones' => $nominaciones,
            'alternativos' => $alternativos,
            'actores' => $actores,
            'generos' => $generos,
            'costos' => $costos,
        ]);
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
            // si modifica un video registrar en la tabla audit
            session_start();
            $this->audit->registrarAuditoria([
                'cod_user'=> $_SESSION['cod_user'],
                'cod_video'=> $id,
                'action'=> 'MODIFICACIÓN',
                'quantity'=> $request['quantity'],
                'date'=> date('Y-m-d'),
                'time'=> date('H:i:s')
            ]);

            header('location:/'.APP_NAME.'/video?modificado');
        }
        else{
            header('location:/'.APP_NAME.'/video/edit/'.$id.'?error');
        }
    }

    public function destroy($id){
        $respuesta = $this->video->actualizarStatus($id,0);
        if($respuesta)
        {
            // si modifica elimina un video registrar en la tabla audit
            session_start();
            $this->audit->registrarAuditoria([
                'cod_user'=> $_SESSION['cod_user'],
                'cod_video'=> $id,
                'action'=> 'ELIMINACIÓN',
                'quantity'=> '1',
                'date'=> date('Y-m-d'),
                'time'=> date('H:i:s')
            ]);

            header('location:/'.APP_NAME.'/video?eliminado');
        }
        else{
            header('location:/'.APP_NAME.'/video/?error');
        }
    }

     public function infoVideo($id)
    {
        $video = $this->video->video($id);
        $costo = $this->costo->costo($video->cod_cost);

        echo json_encode([
            'title' => $video->title,
            'costo_unitario' => $costo->unit_cost,
            'costo1' => $costo->cost_one_day,
            'costo2' => $costo->cost_two_day,
            'costo3' => $costo->cost_three_day,
            'costo4' => $costo->cost_four_day,
            'costo5' => $costo->cost_five_day,
        ]);
    }

    public function copias($id)
    {
        $request = [];
        if(isset($_REQUEST))
        {
            $request = $_REQUEST;
        }

        $video = $this->video->video($id);
        // REGISTRAR COPIAS. LA ACTUALIZACION DEL STOCK SE HACE DENTRO DE LA FUNCION
        $resp = $this->video->copias([
            'quantity' => $request['cantidad'],
            'date' => date('Y-m-d'),
            'cod_video' => $video->cod_video
        ]);

        if($resp)
        {
            //SI LA RESP. ES TRUE REGISTRAR LA AUDITORIA
            session_start();
            $this->audit->registrarAuditoria([
                'cod_user'=> $_SESSION['cod_user'],
                'cod_video'=> $video->cod_video,
                'action'=> 'COPIAS',
                'quantity'=> $request['cantidad'],
                'date'=> date('Y-m-d'),
                'time'=> date('H:i:s')
            ]);
        }

        header('location:/'.APP_NAME.'/video?bien');

    }

    public function bajas($id)
    {
        $request = [];
        if(isset($_REQUEST))
        {
            $request = $_REQUEST;
        }

        $video = $this->video->video($id);
        // REGISTRAR BAJAS. LA ACTUALIZACION DEL STOCK SE HACE DENTRO DE LA FUNCION
        $resp = $this->video->bajas([
            'quantity' => $request['cantidad'],
            'reason' => $request['reason'],
            'date' => date('Y-m-d'),
            'cod_video' => $video->cod_video
        ]);

        if($resp)
        {
            //SI LA RESP. ES TRUE REGISTRAR LA AUDITORIA
            session_start();
            $this->audit->registrarAuditoria([
                'cod_user'=> $_SESSION['cod_user'],
                'cod_video'=> $video->cod_video,
                'action'=> 'BAJAS',
                'quantity'=> $request['cantidad'],
                'date'=> date('Y-m-d'),
                'time'=> date('H:i:s')
            ]);
        }

        header('location:/'.APP_NAME.'/video?bien');
    }

    public function mayorDuracionDrama()
    {
        $videos = $this->video->mayorDuracionDrama();
        $this->vista('videos/mayorDuracion',[
            'request' => 'video',
            'videos' => $videos,
        ]);
    }

    public function masAlquiladosPocoStock()
    {
        $videos = $this->video->masAlquiladosPocoStock();
        $this->vista('videos/masAlquilados',[
            'request' => 'video',
            'videos' => $videos,
        ]);
    }
}