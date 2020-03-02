<?php 
    
    require_once 'MAlternativo.php';
    require_once 'MActor.php';
    require_once 'MNominacion.php';

    class MVideo{
        private $db;

        public function __construct(){
            $this->db = new Conexion;
        }

        public function registrarVideo($datos)
        {
            $this->db->query("INSERT INTO video VALUES('".$datos["cod_video"]."','".$datos["title"]."','".$datos["duration"]."','".$datos["year_publication"]."',".$datos['quantity'].",".$datos['quantity'].",'".$datos["genre_id"]."','".$datos["cod_cost"]."',1)");
            $resp = $this->db->execute();

            if($resp == 1)
            {
                $titulos = [];
                if(isset($datos['alternativos']))
                {
                    $titulos = $datos["alternativos"];
                }
                if(count($titulos))
                {
                    foreach($titulos as $titulo)
                    {
                        $this->db->query("INSERT INTO alternative_title (title,cod_video) VALUES('".$titulo."','".$datos["cod_video"]."')");
                        $this->db->execute();
                    }
                }
                $nominaciones = [];
                $gano = [];
                if(isset($datos['nominaciones']))
                {
                    $nominaciones = $datos["nominaciones"];
                }
                if(isset($datos['gano']))
                {
                    $gano = $datos["gano"];
                }
                if(count($nominaciones) > 0)
                {
                    for($i=0; $i<count($nominaciones); $i++)
                    {
                        $this->db->query("INSERT INTO nomination (tipo,won,cod_video) VALUES('".$nominaciones[$i]."','".$gano[$i]."','".$datos["cod_video"]."')");
                        $this->db->execute();
                    }
                }
                $actores = [];
                if(isset($datos['actores']))
                {
                    $actores = $datos["actores"];
                }
                if(count($actores) > 0)
                {
                    foreach($actores as $actor)
                    {
                        $this->db->query("INSERT INTO main_actor (name,cod_video) VALUES('".$actor."','".$datos["cod_video"]."')");
                        $this->db->execute();
                    }
                }

                return true;
            }
            return false;
        }   

        public function actualizarVideo($datos,$id){
            $this->db->query("UPDATE video SET title='".$datos["title"]."', duration=".$datos['duration'].",year_publication=".$datos['year_publication'].",quantity=".$datos['quantity'].",genre_id=".$datos['genre_id'].",cod_cost='".$datos['cod_cost']."' WHERE cod_video = '".$id."'");
            $resp = $this->db->execute();
            if($resp == 1)
            {
                // VALIDAR LA INFORMACIÓN EXISTENTE
                $existeAlternativo = [];
                $existeNominacion = [];
                $existeActor = [];
                if(isset($datos['existeAlternativo']))
                {
                    $existeAlternativo = $datos['existeAlternativo'];
                }
                if(isset($datos['existeNominacion']))
                {
                    $existeNominacion = $datos['existeNominacion'];
                }

                if(isset($datos['existeActor']))
                {
                    $existeActor = $datos['existeActor'];
                }
                //instanciar los objetos
                $m_actor = new MActor();
                $m_nominacion = new MNominacion();
                $m_alternativo = new MAlternativo();
                $alternavitos_videos = $m_alternativo->alternativosVideo($id);
                $nominaciones_videos = $m_nominacion->nominacionesVideo($id);
                $actores_videos = $m_actor->actoresVideo($id);
                // comprobar alternativos
                if(count($alternavitos_videos) > 0)
                {
                    foreach($alternavitos_videos as $alt)
                    {
                        if(!in_array($alt->id,$existeAlternativo)){
                            $m_alternativo->delete($alt->id);
                        }
                    }
                }
                // comprobar nominaciones
                if(count($nominaciones_videos) > 0)
                {
                    foreach($nominaciones_videos as $nom)
                    {
                        if(!in_array($nom->id,$existeNominacion)){
                            $m_nominacion->delete($nom->id);
                        }
                    }
                }

                // comprobar actores
                if(count($actores_videos) > 0)
                {
                    foreach($actores_videos as $act)
                    {
                        if(!in_array($act->id,$existeActor)){
                            $m_actor->delete($act->id);
                        }
                    }
                }

                // REGISTRAR LA NUEVA INFORMACIÓN
                $titulos = [];
                if(isset($datos['alternativos']))
                {
                    $titulos = $datos["alternativos"];
                }
                if(count($titulos))
                {
                    foreach($titulos as $titulo)
                    {
                        $this->db->query("INSERT INTO alternative_title (title,cod_video) VALUES('".$titulo."','".$datos["cod_video"]."')");
                        $this->db->execute();
                    }
                }
                $nominaciones = [];
                $gano = [];
                if(isset($datos['nominaciones']))
                {
                    $nominaciones = $datos["nominaciones"];
                }
                if(isset($datos['gano']))
                {
                    $gano = $datos["gano"];
                }
                if(count($nominaciones) > 0)
                {
                    for($i=0; $i<count($nominaciones); $i++)
                    {
                        $this->db->query("INSERT INTO nomination (tipo,won,cod_video) VALUES('".$nominaciones[$i]."','".$gano[$i]."','".$datos["cod_video"]."')");
                        $this->db->execute();
                    }
                }
                $actores = [];
                if(isset($datos['actores']))
                {
                    $actores = $datos["actores"];
                }
                if(count($actores) > 0)
                {
                    foreach($actores as $actor)
                    {
                        $this->db->query("INSERT INTO main_actor (name,cod_video) VALUES('".$actor."','".$datos["cod_video"]."')");
                        $this->db->execute();
                    }
                }

                return true;
            }
            return false;
        }

        public function video($id){
            $this->db->query("SELECT * FROM video WHERE cod_video = '$id'");
            return $this->db->registro();
        }

        public function actualizarStatus($id, $valor){
            $this->db->query("UPDATE video SET status=".$valor." WHERE cod_video = '".$id."'");
            return $this->db->execute();
        }
 
        public function lista()
        {
            $this->db->query("SELECT v.*, g.name as genero, c.unit_cost as costo FROM video v INNER JOIN genre g on g.id = v.genre_id INNER JOIN cost c on c.cod_cost = v.cod_cost WHERE v.status = 1");
            $lista = $this->db->registros();
            return $lista;
        }

        public function listaOrdenada($order = 'DESC', $column='title')
        {
            $this->db->query("SELECT v.*, g.name as genero, c.unit_cost as costo FROM video v INNER JOIN genre g on g.id = v.genre_id INNER JOIN cost c on c.cod_cost = v.cod_cost WHERE v.status = 1 ORDER BY $column $order");
            $lista = $this->db->registros();
            return $lista;
        }
        public function ultimoRegistro()
        {
            $this->db->query("SELECT cod_video FROM video ORDER BY cod_video DESC LIMIT 1");
            $ultimo_video = $this->db->registro();
            return $ultimo_video;
        }

        public function alternativosTitle($id)
        {
            $this->db->query("SELECT title FROM alternative_title WHERE cod_video ='$id'");
            $lista = $this->db->registros();
            return $lista;
        }

        public function actoresName($id)
        {
            $this->db->query("SELECT name FROM main_actor WHERE cod_video ='$id'");
            $lista = $this->db->registros();
            return $lista;
        }

        public function nominacionesTipo($id)
        {
            $this->db->query("SELECT tipo FROM nomination WHERE cod_video ='$id'");
            $lista = $this->db->registros();
            return $lista;
        }

                
    }