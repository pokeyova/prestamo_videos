<?php
    
    class MAudit{
        private $db;

        public function __construct(){
            $this->db = new Conexion;
        }

        public function registrarAuditoria($datos)
        {
            $codigo = '';

            $this->db->query("INSERT INTO cost VALUES('".$codigo."',".$datos["unit_cost"].",".$datos["cost_one_day"].",".$datos["cost_two_day"].",".$datos["cost_three_day"].",".$datos["cost_four_day"].",".$datos["cost_five_day"].")");

            $this->db->execute();
        }   
        
        public function lista()
        {
            $this->db->query("SELECT a.*, CONCAT(p.name,' ',p.last_name) as usuario, v.title FROM audit a INNER JOIN user u on u.cod_user = a.cod_user INNER JOIN video v on v.cod_video = a.cod_video INNER JOIN personal p on p.cod_user = u.cod_user");
            return $this->db->registros();
        }

    }