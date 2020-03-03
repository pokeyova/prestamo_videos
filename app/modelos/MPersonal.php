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
            // CODIGO DE USUARIO
            // combinacion de las iniciales del nombre y apellido mas un numero incremental
            $inicial_n_p = strtoupper(substr($datos['name'],0,1).substr($datos['last_name'],0,1));
            $codigo_user = $inicial_n_p.$ultimo_numero;
            
            // NOMBRE DE USUARIO INICIAL DEL NOMBRE Y APELLIDO
            $name_user = strtoupper(substr($datos['name'],0,1).$datos['last_name']);
            $contador = 0;
            while($user->existeName($name_user))
            {   
                $contador++;
                $name_user = strtoupper(substr($datos['name'],0,1).$datos['last_name']).$contador;
            }

            // REGISTRAR USUARIO
            $resp = $user->registrarUsuario(['cod_user'=>$codigo_user,'name'=>$name_user,'password'=>$c_user->passwordHash($datos['ci']),'type'=>$datos['type'],'register_date'=>date('Y-m-d')]);
            if($resp)
            {
                // SI EL REGISTRO FUE EXITOSO REGISTRAR LOS DATOS DEL PERSONAL
                $codigo = '';
                $ultimo_personal = $this->ultimoRegistro();
            
                if($ultimo_personal)
                {
                    $codigo = (int)(substr($ultimo_personal->cod_personal,1,strlen($ultimo_personal->cod_personal)));
                    $codigo = $codigo + 1;
                    if($codigo < 10)
                    {
                        $codigo = 'P00'.$codigo;
                    }
                    elseif($codigo < 100){
                        $codigo = 'P0'.$codigo;
                    }
                    else{
                        $codigo = 'P'.$codigo;
                    }
                }
                else{
                    $codigo = 'P001';
                }
    
                $this->db->query("INSERT INTO personal VALUES('".$codigo."','".$datos["name"]."','".$datos["last_name"]."','".$datos["ci"]."','".$datos["issued"]."','".$datos["email"]."','".$datos["phone"]."','".$codigo_user."',1)");
    
                return $this->db->execute();
            }
            return false;
        }   
        
     
    }