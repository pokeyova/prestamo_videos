<?php 
    
    class MBorrowing{
        private $db;

        public function __construct(){
            $this->db = new Conexion;
        }

        public function registrarPrestamo($datos)
        {
            $codigo = 'P001';
            $ultimo_codigo = $this->ultimoRegistro();
            if($ultimo_codigo)
            {   
                $codigo = (int)(substr($ultimo_codigo->cod_borrowing,1,strlen($ultimo_codigo->cod_borrowing)));
                $codigo++;
                if($codigo < 10)
                {
                    $codigo = 'P00'.$codigo;
                }
                elseif($codigo < 100){
                    $codigo = 'P0'.$codigo;
                }
                else{
                    $codigo = 'P'.$codigo;
                }
            }
            $this->db->query("INSERT INTO borrowing VALUES('".$codigo."','".$datos["cod_client"]."','".$datos["borrow_date"]."','".$datos["return_date"]."','EN CURSO')");

            $resp = $this->db->execute();
            if($resp == 1)
            {
                return $codigo;
            }
            return '';
        }   
        public function lista()
        {
            $this->db->query("SELECT b.*, CONCAT(c.name,' ',c.last_name) as cliente FROM borrowing b INNER JOIN client c on c.cod_client = b.cod_client");
            return $this->db->registros();
        }

        public function cantidadVideos($id)
        {
            $this->db->query("SELECT SUM(quantity) as cantidad FROM borrowing_videos WHERE cod_borrowing = '$id'");
            $cantidad = $this->db->registro();
            return $cantidad;
        }

        public function ultimoRegistro()
        {
            $this->db->query("SELECT cod_borrowing FROM borrowing ORDER BY cod_borrowing DESC LIMIT 1");
            $ultimo = $this->db->registro();
            return $ultimo;
        }

        public function prestamo($id){
            $this->db->query("SELECT * FROM borrowing WHERE cod_borrowing = '$id'");
            return $this->db->registro();
        }

        public function detallePrestamo($id){
            $this->db->query("SELECT b.*, CONCAT(c.name,' ',c.last_name) as cliente, c.ci as nit FROM borrowing b INNER JOIN client c on c.cod_client = b.cod_client WHERE cod_borrowing = '$id'");
            return $this->db->registro();
        }

        public function descuento($id){
            $this->db->query("SELECT d.discount FROM discount_borrowing db INNER JOIN discount d on d.cod_discount = db.cod_discount WHERE cod_borrowing = '$id'");
            return $this->db->registro();
        }

        public function factura($id){
            $this->db->query("SELECT * FROM invoice WHERE cod_borrowing = '$id'");
            return $this->db->registro();
        }

        public function detalleFactura($id){
            $this->db->query("SELECT id.*, v.title FROM invoice_detail id INNER JOIN video v on v.cod_video = id.cod_video WHERE cod_invoice ='$id'");
            return $this->db->registros();
        }

        /* FUNCIONES PARA REGISTRAR EL PRESTAMO */
        public function registrarVideos($datos)
        {
            $this->db->query("INSERT INTO borrowing_videos (cod_borrowing,cod_video,quantity) VALUES('".$datos['cod_borrowing']."','".$datos["cod_video"]."',".$datos["quantity"].")");

            return $this->db->execute();
        }

        public function registraDescuento($datos)
        {
            $this->db->query("INSERT INTO discount_borrowing (cod_discount,cod_borrowing) VALUES('".$datos['cod_discount']."','".$datos["cod_borrowing"]."')");

            return $this->db->execute();
        }

        public function registraFactura($datos)
        {

             // CREAR UN CÓDIGO DE CONTROL
            // crear un array
            $array_codigo = [];
            for($i = 1; $i <= 9; $i++)
            {
                $array_codigo[] = $i;//agregar los números del 1 al 9
            }
            array_push($array_codigo,'A','B','C','D','E','F');//agregar las letras para poder generar un # hexadecimal
            //generar el código
            $codigo_control = '';
            for($i = 1; $i <= 10; $i++)
            {
                $indice = mt_rand(0,14);
                $codigo_control .= $array_codigo[$indice];
                if($i % 2 == 0)
                {
                    $codigo_control .= '-';
                }
            }        

            $codigo_control = substr($codigo_control,0,strlen($codigo_control) - 1);//quitar el ultimo guión

            $codigo = '1001';
            $ultimo_codigo = $this->ultimoRegistroFactura();
            if($ultimo_codigo)
            {   
                $codigo = (int)($ultimo_codigo->cod_invoice);
                $codigo++;
            }
            $this->db->query("INSERT INTO invoice VALUES('".$codigo."','".$datos['cod_client']."','".$datos['cod_borrowing']."','".$datos['total']."','".$datos['end_total']."','".$codigo_control."','".date('Y-m-d')."')");

            $resp = $this->db->execute();
            if($resp == 1)
            {
                return $codigo;
            }
            return false;
        }

        public function ultimoRegistroFactura()
        {
            $this->db->query("SELECT cod_invoice FROM invoice ORDER BY cod_invoice DESC LIMIT 1");
            $ultimo = $this->db->registro();
            return $ultimo;
        }

        public function registraDetalle($datos)
        {
            $this->db->query("INSERT INTO invoice_detail (cod_invoice,cod_video,unit_cost,quantity,total) VALUES('".$datos['cod_invoice']."','".$datos["cod_video"]."',".$datos["unit_cost"].",".$datos["quantity"].",".$datos["total"].")");

            return $this->db->execute();
        }

        public function estado($id,$estado){
            $this->db->query("UPDATE borrowing SET `status` = '$estado' WHERE cod_borrowing = '$id'");
            return $this->db->execute();
        }
    }