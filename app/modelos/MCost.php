<?php 
    
    class MCost{
        private $db;

        public function __construct(){
            $this->db = new Conexion;
        }

        public function registrarCosto($datos)
        {
            $codigo = '';
            $ultimo_codigo = $this->ultimoRegistro();
            $codigo = 'COS1';
            if($ultimo_codigo)
            {   
                $codigo = (int)(substr($ultimo_codigo->cod_cost,3,strlen($ultimo_codigo->cod_cost)));
                $codigo++;
                $codigo = 'COS'.$codigo;
            }

            $this->db->query("INSERT INTO cost VALUES('".$codigo."',".$datos["unit_cost"].",".$datos["unit_cost"].",".$datos["cost_two_day"].",".$datos["cost_three_day"].",".$datos["cost_four_day"].",".$datos["cost_five_day"].")");
            return $this->db->execute();
        }   
        
        public function lista()
        {
            $this->db->query("SELECT * FROM cost");
            return $this->db->registros();
        }

        public function ultimoRegistro()
        {
            $this->db->query("SELECT cod_cost FROM cost ORDER BY cod_cost DESC LIMIT 1");
            $ultimo = $this->db->registro();
            return $ultimo;
        }

        public function costo($id)
        {
            $this->db->query("SELECT * FROM cost WHERE cod_cost ='$id'");
            $costo = $this->db->registro();
            return $costo;
        }

        public function costVideo($id)
        {
            $this->db->query("SELECT * FROM video WHERE cod_cost = '$id'");
            return $this->db->registros();
        }

        public function delete($id){
            $this->db->query("DELETE FROM cost WHERE cod_cost = '$id'");
            return $this->db->execute();
        }

        public function actualizarCost($datos,$id)
        {
            $this->db->query("UPDATE cost SET unit_cost='".$datos["unit_cost"]."',cost_one_day='".$datos["unit_cost"]."',cost_two_day='".$datos["cost_two_day"]."',cost_three_day='".$datos["cost_three_day"]."',cost_four_day='".$datos["cost_four_day"]."',cost_five_day='".$datos["cost_five_day"]."' WHERE cod_cost = '$id'");
            $resp = $this->db->execute();

            if($resp == 1)
            {
                return true;
            }
            return false;
        }
    }