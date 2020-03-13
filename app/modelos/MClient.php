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

        public function registrarCliente($datos)
        {
            $ultimo_client = $this->ultimoRegistro();
            $codigo = '';
            if($ultimo_client)
            {
                $codigo = (int)(substr($ultimo_client->cod_client,1,strlen($ultimo_client->cod_client)));
                $codigo = $codigo + 1;
                if($codigo < 10)
                {
                    $codigo = 'C00'.$codigo;
                }
                elseif($codigo < 100){
                    $codigo = 'C0'.$codigo;
                }
                else{
                    $codigo = 'C'.$codigo;
                }
            }
            else{
                $codigo = 'C001';
            }

            $this->db->query("INSERT INTO client VALUES('".$codigo."','".$datos["name"]."','".$datos["last_name"]."','".$datos["ci"]."','".$datos["issued"]."','".$datos["email"]."','".$datos["date_birth"]."','".$datos["address"]."','".$datos["location"]."','".$datos["registration_date"]."',1)");

            return $this->db->execute();
        }   

        public function actualizarCliente($datos,$id){
            $this->db->query("UPDATE client SET name='".$datos["name"]."', last_name='".$datos['last_name']."',ci=".$datos['ci'].",issued='".$datos['issued']."',email='".$datos['email']."',date_birth='".$datos['date_birth']."' ,address='".$datos['address']."',location='".$datos['location']."' WHERE cod_client = '".$id."'");
            return $this->db->execute();
        }

        public function actualizarStatus($id,$valor)
        {
            $this->db->query("UPDATE client SET status = '$valor' WHERE cod_client = '".$id."'");
            return $this->db->execute();
        }

        public function ultimoRegistro()
        {
            $this->db->query("SELECT cod_client FROM client ORDER BY cod_client DESC LIMIT 1");
            $ultimo_client = $this->db->registro();
            return $ultimo_client;
        }

        public function cliente($id){
            $this->db->query("SELECT * FROM client WHERE cod_client = '$id'");
            return $this->db->registro();
        }
    }