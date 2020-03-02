<?php 
    
    class MUser{
        private $db;

        public function __construct(){
            $this->db = new Conexion;
        }

        public function registrarUsuario($datos)
        {
            $this->db->query("INSERT INTO user VALUES('".$datos["cod_user"]."','".$datos["name"]."','".$datos["password"]."','".$datos["type"]."','".$datos["register_date"]."')");

            return $this->db->execute();
        }

        public function validaLogin($name, $password)
        {
            $this->db->query("SELECT * FROM user WHERE name = '$name'");
            $user = new MUser();
            $user = $this->db->registro();
            if($this->validaHash($password,$user->password) == 1)
            {
                return $user;
            }
            return false;
        }
    
        public function usuario($id){
            $this->db->query("SELECT * FROM user WHERE cod_user = '$id'");
            $user = new MUser();
            $user = $this->db->registro();
            return $user;
        }

        public function validaHash($cadena1, $cadena2)
        {
            $resp = password_verify($cadena1, $cadena2);//('cadena_comparar','cadena_hash')
            return $resp;
        }

        public function ultimoNumeroCodigo()
        {
            $this->db->query("SELECT CAST(SUBSTRING(cod_user, 3, length(cod_user)) AS UNSIGNED) as cod_user FROM `user` WHERE cod_user != 'A1' ORDER BY cod_user DESC");
            $ultimo_numero = $this->db->registro();
            return $ultimo_numero;
        }

        public function existeName($name)
        {
            $this->db->query("SELECT name FROM user WHERE name ='$name'");
            $existe = $this->db->registro();
            return $existe;
        }
    }