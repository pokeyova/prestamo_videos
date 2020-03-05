<?php 
    
    class MClientLocked{
        private $db;

        public function __construct(){
            $this->db = new Conexion;
        }

        public function lista()
        {
            $this->db->query("SELECT * FROM client WHERE status = 1");
            $lista = $this->db->registros();
            return $lista;
        }

        public function clientesBloqueados()
        {
            $this->db->query("SELECT * FROM client WHERE status = 1");
            $lista = $this->db->registros();
            return $lista;
        }

        public function registrarBloqueo($datos)
        {
            $this->db->query("INSERT INTO client_locked (cod_client, reason, register_date,status) VALUES('".$datos['cod_client']."','".$datos['reason']."','".$datos['register_date']."',1)");
            return $this->db->execute();
        }   

        public function actualizarStatus($id,$valor)
        {
            $this->db->query("UPDATE client_locked SET status=".$valor." WHERE id = ".$id);
            return $this->db->execute();
        }  
    }