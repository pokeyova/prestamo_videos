<?php 
    
    class MActor{
        private $db;

        public function __construct(){
            $this->db = new Conexion;
        }

        public function registraActor($datos)
        {
            $this->db->query("INSERT INTO main_actor (name,cod_video) VALUES('".$datos['name']."','".$datos["cod_video"]."')");
            $this->db->execute();
        }

        public function actoresVideo($id)
        {
            $this->db->query("SELECT * FROM main_actor WHERE cod_video = '$id'");
            return $this->db->registros();
        }   

        public function delete($id){
            $this->db->query("DELETE FROM main_actor WHERE id = $id");
            return $this->db->execute();
        }
    }