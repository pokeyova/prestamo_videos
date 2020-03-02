<?php 
    // Clase controlador principal
    // Se encarga de poder cargar los modelos y las vistas

    class Controlador{

        // Cargar modelo
        public function modelo($modelo){
            // requerir el modelo
            require_once '../app/modelos/'. $modelo .'.php';

            // instanciar el modelo y retornarlo
            return new $modelo;
        }

        // Cargar vista
        public function vista($vista, $datos = []){
            // Verificar si el archivo vista existe
            if(file_exists('../app/vistas/'. $vista .'.php'))
            {
                // requerir la vista
                require_once '../app/vistas/'. $vista .'.php';
            }
            else{
                // Si no existe retornamos un mensaje de error
                die("La vista no existe.");
            }
        }
    }