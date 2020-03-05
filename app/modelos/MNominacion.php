<?php 
    
    class MNominacion{
        private $db;

        public function __construct(){
            $this->db = new Conexion;
        }

        public function registrarNominacion($datos){
            $this->db->query("INSERT INTO nomination (tipo,won,cod_video) VALUES('".$datos['tipo']."','".$datos['won']."','".$datos["cod_video"]."')");
            $this->db->execute();
        }

        public function nominacionesVideo($id)
        {
            $this->db->query("SELECT * FROM nomination WHERE cod_video = '$id'");
            return $this->db->registros();
        }  

        public function delete($id){
            $this->db->query("DELETE FROM nomination WHERE id = $id");
            return $this->db->execute();
        }
    }