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

            $actores = $this->video->actoresName($video->cod_video);
            $array_actores[$video->cod_video] = '';
            if(count($actores) > 0)
            {
                foreach($actores as $actor)
                {
                    $array_actores[$video->cod_video] .= $actor->name.' ';
                }
            }

            $nominaciones = $this->video->nominacionesTipo($video->cod_video);
            $array_nominaciones[$video->cod_video] = '';
            if(count($nominaciones) > 0)
            {
                foreach($nominaciones as $nominacion)
                {
                    $array_nominaciones[$video->cod_video] .= $nominacion->tipo.' ';
                }
            }
        }

        $this->vista('prestamos/create',[
                        'request' => 'borrowing',
                        'videos' => $videos,
                        'generos' => $generos,
                        'clientes' => $clientes,
                        'array_alternativos' => $array_alternativos,
                        'array_actores' => $array_actores,
                        'array_nominaciones' => $array_nominaciones,
                        ]);
    }

    public function store(){
        $request = [];
        if(isset($_REQUEST))
        {
            $request = $_REQUEST;
        }

        //REGISTRAR EL PRÉSTAMO
        $codigo_prestamo = $this->prestamo->registrarPrestamo([
            'cod_client' => $request['cod_client'],
            'borrow_date' => $request['borrow_date'],
            'return_date' => $request['return_date'],
        ]);
        // REGISTRAR LOS VIDEOS DEL PRESTAMO
        for($i = 0; $i < count($request['codigos']); $i++)
        {   
            $this->prestamo->registrarVideos([
                'cod_borrowing' => $codigo_prestamo,
                'cod_video' => $request['codigos'][$i],
                'quantity' => $request['cantidades'][$i],
            ]);
        }
        // REGISTRAR EL DESCUENTO SIEMPRE Y CUANDO SEA DISTINTO DE ""
        if($request['cod_discount'] != '')
        {
            $this->prestamo->registraDescuento([
                'cod_discount' => $request['cod_discount'],
                'cod_borrowing' => $codigo_prestamo,
            ]);
        }

        // REGISTRAR FACTURA
        $codigo_factura = $this->prestamo->registraFactura([
            'cod_client' => $request['cod_client'],
            'cod_borrowing' => $codigo_prestamo,
            'total' => $request['total'],
            'end_total' => $request['total_final'],
        ]);

        // REGISTRAR DETALLE FACTURA
        for($i = 0; $i < count($request['codigos']); $i++)
        {   
            $this->prestamo->registraDetalle([
                'cod_invoice' => $codigo_factura,
                'cod_video' => $request['codigos'][$i],
                'unit_cost' => $request['precios'][$i],
                'quantity' => $request['cantidades'][$i],
                'total' => $request['totales'][$i],
            ]);
            // actualizar stock del video
            $this->video->actualizaStock($request['codigos'][$i],$request['cantidades'][$i],'PRESTAMO');
        }

        echo json_encode(['msj'=>true,'cod_prestamo'=>$codigo_prestamo]);
    }

    public function show($id){
        $prestamo = $this->prestamo->detallePrestamo($id);
        $factura = $this->prestamo->factura($id);
        $detalle_factura = $this->prestamo->detalleFactura($factura->cod_invoice);
        $descuento = $this->prestamo->descuento($id);
        if($descuento)
        {
            $descuento = $descuento->discount;
        }
        else{
            $descuento = "0.00";
        }

        $this->vista('prestamos/show',[
            'request' => 'borrowing',
            'empresa' => 'Video club "Media"',
            'prestamo' => $prestamo,
            'factura' => $factura,
            'descuento' => $descuento,
            'detalle_factura' => $detalle_factura,
        ]);
    }

    public function imprimir($id){
        $prestamo = $this->prestamo->detallePrestamo($id);
        $factura = $this->prestamo->factura($id);
        $detalle_factura = $this->prestamo->detalleFactura($factura->cod_invoice);
        $descuento = $this->prestamo->descuento($id);
        if($descuento)
        {
            $descuento = $descuento->discount;
        }
        else{
            $descuento = "0.00";
        }

        $this->vista('prestamos/imprimir',[
            'request' => 'borrowing',
            'empresa' => 'Video club "Media"',
            'prestamo' => $prestamo,
            'factura' => $factura,
            'descuento' => $descuento,
            'detalle_factura' => $detalle_factura,
        ]);
    }

    public function edit($id){
        
    }

    public function update($id){
        
    }

    public function destroy($id){
        
    }

    public function estado($id)
    {

        $request = [];
        if(isset($_REQUEST))
        {
            $request = $_REQUEST;
        }

        $respuesta = $this->prestamo->estado($id,$request['estado']);
        if($respuesta)
        {
            header('location:/'.APP_NAME.'/borrowing?modificado');
        }
        else{
            header('location:/'.APP_NAME.'/borrowing/?error');
        }
    }

    public function validaFecha()
    {
        $request = [];
        if(isset($_REQUEST))
        {
            $request = $_REQUEST;
        }
        $f1 = $request['f1'];
        $f2 = $request['f2'];
        
        // validar que la fecha2 sea mayor a la fecha1
        if(date('Y-m-d',strtotime($f1)) < date('Y-m-d',strtotime($f2)))
        {
            // si cumple validar que la diferencia de días no sea mayor a 5
            $fecha1 = new DateTime($f1);
            $fecha2 = new DateTime($f2);
            $intervalo = $fecha1->diff($fecha2);
            if($intervalo->d <= 5 && $intervalo->m == 0)
            {
                // si el intervalo de días es menor o igual a 5 devolver correcto
                echo json_encode([
                    'msj' => 'correcto',
                    'intervalo' => $intervalo->d,
                ]);
            }
            else{
                // caso contrario devolver el msj y las fechas seteadas
                echo json_encode([
                    'msj' => 'mayor',
                    'f1' => date('Y-m-d',strtotime($f1)),
                    'f2' => date('Y-m-d',strtotime($f1."+ 5 day")),
                ]);
            }
        }
        else{
            // caso contrario devolver el msj y las fechas seteadas
            echo json_encode([
                'msj' => 'menor',
                'f1' => date('Y-m-d',strtotime($f1)),
                'f2' => date('Y-m-d',strtotime($f1."+ 1 day")),
            ]);
        }
    }
}