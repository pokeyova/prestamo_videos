<?php

    require_once RUTA.'/config/config.php';
    
    class Conexion{


        private $host = DB_HOST;
        private $user = DB_USER;
        private $pass = DB_PASS;
        private $name = DB_NAME;

        private $dbh; //database handler
        private $stmt; //statament (ejecutar una consulta)
        private $error;

        public function __construct(){
            // configurar conexion
            $dsn = 'mysql:host=' .$this->host. ';dbname=' .$this->name;

            $opciones = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );

            // Crear una instancia de PDO
            try {
                $this->dbh = new PDO($dsn, $this->user, $this->pass, $opciones);
                $this->dbh->exec('set names utf8');
            } catch (PDOException $e) {
                $this->error = $e->getMessage();
                echo $this->error;
            }
        }

        // Preparamos la consulta
        public function query($sql){
            $this->stmt = $this->dbh->prepare($sql);
        }

        // Vinculamos la consulta con bind
        public function bind($parametro, $valor, $tipo = null){
            if(is_null($tipo)){
                switch (true) {
                    case is_int($valor):
                        $tipo = PDO::PARAM_INT;
                        break;
                    case is_bool($valor):
                        $tipo = PDO::PARAM_BOOL;
                        break;
                    case is_null($valor):
                        $tipo = PDO::PARAM_NULL;
                        break;
                     
                    default:
                        $tipo = PDO::PARAM_STR;
                        break;
                } 
            }
            $this->stmt->bindValue($parametro, $valor, $tipo);
        }

        // Ejecuta la consulta
        public function execute(){
            return $this->stmt->execute();
        }

         // Obtener los registros de la consulta
         public function registros(){
            $this->execute();
            return $this->stmt->fetchAll(PDO::FETCH_OBJ);
        }

        // Obtener un solo registro
        public function registro(){
            $this->execute();
            return $this->stmt->fetch(PDO::FETCH_OBJ);
        }

        // Obtener la cantidad de registros con el método rowCount
        public function cantidad(){
            return $this->stmt->rowCount();
        }
    }
?>