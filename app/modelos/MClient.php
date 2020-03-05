<?php 
    
    class MClient{
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

        public function bloqueo($id)
        {
            $this->db->query("SELECT * FROM client_locked WHERE cod_client = '$id' AND status = 1 ORDER BY register_date DESC");
            $bloqueo = $this->db->registro();
            return $bloqueo;
        }

        public function bloqueos($id)
        {
            $this->db->query("SELECT * FROM client_locked WHERE cod_client = '$id' ORDER BY date DESC");
            $lista = $this->db->registros();
            return $lista;
        }

        
    }