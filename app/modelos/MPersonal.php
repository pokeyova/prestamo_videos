<?php 
    require_once 'MUser.php';
    require_once RUTA.'/controladores/User.php';
    class MPersonal{
        private $db;

        public function __construct(){
            $this->db = new Conexion;
        }

        public function lista()
        {
            $this->db->query("SELECT p.*, u.name as usuario, u.type as tipo, u.register_date as registro FROM personal p INNER JOIN user u on u.cod_user = p.cod_user WHERE p.status = 1");
            $lista = $this->db->registros();
            return $lista;
        }

        public function registrarPersonal($datos)
        {
            $codigo_user = '';
            $user = new MUser();
            $c_user = new User();
            $ultimo_numero = (int)$user->ultimoNumeroCodigo();
            if($ultimo_numero)
            {
                $ultimo_numero++;
            }
            else{
                $ultimo_numero = 1;
            }
            
     
    }