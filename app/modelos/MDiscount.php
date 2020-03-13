<?php 
    
    class MDiscount{
        private $db;

        public function __construct(){
            $this->db = new Conexion;
        }

        public function registrarDescuento($datos)
        {
            $codigo = 'DES1';   
            $ultimo_codigo = $this->ultimoRegistro();
            if($ultimo_codigo)
            {
                $codigo = (int)(substr($ultimo_codigo->cod_discount,3,strlen($ultimo_codigo->cod_discount)));
                $codigo++;
                $codigo = 'DES'.$codigo;
            }

            if($datos['to'] == null)
            {
                $this->db->query("INSERT INTO discount VALUES('".$codigo."',".$datos["from"].",NULL,".$datos["discount"].")");
            }
            else{
                $this->db->query("INSERT INTO discount VALUES('".$codigo."',".$datos["from"].",".$datos["to"].",".$datos["discount"].")");
            }

            return $this->db->execute();
        }   
        
        public function descuento($id)
        {
            $this->db->query("SELECT * FROM discount WHERE cod_discount ='$id'");
            $costo = $this->db->registro();
            return $costo;
        }

        public function lista()
        {
            $this->db->query("SELECT * FROM discount");
            return $this->db->registros();
        }

        public function ultimoRegistro()
        {
            $this->db->query("SELECT cod_discount FROM discount ORDER BY cod_discount DESC LIMIT 1");
            $ultimo = $this->db->registro();
            return $ultimo;
        }

        public function actualizarDiscount($datos,$id)
        {

            if($datos['to'] == null)
            {
                $this->db->query("UPDATE discount SET `from`=".$datos["from"].", `to`=NULL, discount=".$datos["discount"]." WHERE cod_discount = '$id'");
            }
            else{
                $this->db->query("UPDATE discount SET `from`=".$datos["from"].", `to`=".$datos["to"].", discount=".$datos["discount"]." WHERE cod_discount = '$id'");
            }

            $resp = $this->db->execute();

            if($resp == 1)
            {
                return true;
            }
            return false;
        }

        public function descuentoPrestamo($id)
        {
            $this->db->query("SELECT * FROM discount_borrowing WHERE cod_discount = '$id'");
            return $this->db->registros();
        }

        public function delete($id){
            $this->db->query("DELETE FROM discount WHERE cod_discount = '$id'");
            return $this->db->execute();
        }

        public function descuentosCantidad($cantidad)
        {
            $this->db->query("SELECT * FROM discount WHERE `from` <= $cantidad ORDER BY `from` DESC");
            $ultimo = $this->db->registros();
            return $ultimo;
        }
    }