<?php 
    
    class MAlternativo{
        private $db;

        public function __construct(){
            $this->db = new Conexion;
        }

        public function registrarTitulo($datos)
        {
            $this->db->query("INSERT INTO alternative_title (title,cod_video) VALUES('".$datos['titulo']."','".$datos["cod_video"]."')");
            $this->db->execute();
        }

        public function alternativosVideo($id)
        {
            $this->db->query("SELECT * FROM alternative_title WHERE cod_video = '$id'");
            return $this->db->registros();
        }    

        public function delete($id){
            $this->db->query("DELETE FROM alternative_title WHERE id = $id");
            return $this->db->execute();
        }

    }