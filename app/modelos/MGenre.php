<?php 
    
    class MGenre{
        private $db;

        public function __construct(){
            $this->db = new Conexion;
        }

        public function registrarGenero($datos)
        {
            $this->db->query("");

            $this->db->execute();
        }   

        public function lista()
        {
            $this->db->query("SELECT * FROM genre");
            return $this->db->registros();
        } 

        public function genreVideo($id)
        {
            $this->db->query("SELECT * FROM video WHERE genre_id = $id");
            return $this->db->registros();
        }

        public function genre($id){
            $this->db->query("SELECT * FROM genre WHERE id = $id");
            return $this->db->registro();
        }

        public function delete($id){
            $this->db->query("DELETE FROM genre WHERE id = $id");
            return $this->db->execute();
        }

        public function registrarGenre($datos)
        {
            $this->db->query("INSERT INTO genre (name,description) VALUES('".$datos["name"]."','".$datos['description']."')");
            $resp = $this->db->execute();

            if($resp == 1)
            {
                return true;
            }
            return false;
        }

        public function actualizarGenre($datos,$id)
        {
            $this->db->query("UPDATE genre SET name='".$datos["name"]."',description='".$datos["description"]."' WHERE id = $id");
            $resp = $this->db->execute();

            if($resp == 1)
            {
                return true;
            }
            return false;
        }

    }