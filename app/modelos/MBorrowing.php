<?php 
    
    class MBorrowing{
        private $db;

        public function __construct(){
            $this->db = new Conexion;
        }

        public function registrarPrestamo($datos)
        {
            $this->db->query("INSERT INTO user VALUES('".$datos["cod_user"]."','".$datos["name"]."','".$datos["password"]."','".$datos["type"]."','".$datos["register_date"]."')");

            $this->db->execute();
        }   

        public function lista()
        {
            $this->db->query("SELECT b.*, CONCAT(c.name,' ',c.last_name) as cliente FROM borrowing b INNER JOIN client c on c.cod_client = b.cod_client");
            return $this->db->registros();
        }

        public function cantidadVideos($id)
        {
            $this->db->query("SELECT SUM(quantity) as cantidad FROM borrowing_videos WHERE cod_borrowing = '$id'");
            $cantidad = $this->db->registro();
            return $cantidad;
        }
    }