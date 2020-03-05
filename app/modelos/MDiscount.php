<?php 
    
    class MDiscount{
        private $db;

        public function __construct(){
            $this->db = new Conexion;
        }

        public function registrarDescuento($datos)
        {
            $codigo = '';

            $this->db->query("INSERT INTO cost VALUES('".$codigo."',".$datos["unit_cost"].",".$datos["cost_one_day"].",".$datos["cost_two_day"].",".$datos["cost_three_day"].",".$datos["cost_four_day"].",".$datos["cost_five_day"].")");

            $this->db->execute();
        }   
        
        public function lista()
        {
            $this->db->query("SELECT * FROM discount");
            return $this->db->registros();
        }

        public function ultimoRegistro()
        {
            $this->db->query("SELECT cod_cost FROM cost ORDER BY cod_cost DESC LIMIT 1");
            $ultimo = $this->db->registro();
            return $ultimo;
        }

    }