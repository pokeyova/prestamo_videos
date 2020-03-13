<?php
    
    class MAudit{
        private $db;

        public function __construct(){
            $this->db = new Conexion;
        }

        public function registrarAuditoria($datos)
        {
            $this->db->query("INSERT INTO `audit` (`cod_user`,`cod_video`,`action`,`quantity`,`date`,`time`) VALUES('".$datos['cod_user']."','".$datos['cod_video']."','".$datos['action']."',".$datos['quantity'].",'".$datos['date']."','".$datos['time']."')");

            return $this->db->execute();
        }   
        
        public function lista()
        {
            $this->db->query("SELECT a.*, CONCAT(p.name,' ',p.last_name) as usuario, v.title as video,u.name as user FROM audit a LEFT JOIN user u on u.cod_user = a.cod_user LEFT JOIN video v on v.cod_video = a.cod_video LEFT JOIN personal p on p.cod_user = u.cod_user");
            return $this->db->registros();
        }
    }