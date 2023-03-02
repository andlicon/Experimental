<?php
    include_once('../rutaAcciones.php');
    include_once(DAO_PATH.'EstudianteDAO.php');
    include_once(DAO_PATH.'BaseDeDatos.php');

    class CargarEstudiante {
        public function cargar() {

            if( isset($_POST['nombre']) && 
                isset($_POST['apellido']) && isset($_POST['fecha']) && 
                isset($_POST['clase']) && isset($_POST['cedula']) && isset($_POST['lugarNacimiento'])
            ) {
                $respuesta = array();

                $nombre = $_POST['nombre'];
                $apellido = $_POST['apellido'];
                $fecha = $_POST['fecha'];
                $clase = $_POST['clase'];
                $cedula = $_POST['cedula'];
                $lugarNacimentio = $_POST['lugarNacimiento'];

                //Falta algo para validar los datos
            
                $estudianteDAO = new EstudianteDAO(BaseDeDatos::getInstancia());
                $estudianteDAO->cargar(array($nombre, $apellido, $fecha, $cedula, $lugarNacimentio));

                array_push($respuesta, array(
                    "tipo"=>"exito",
                    "descripcion"=>"se ha cargado el usuario con exito."
                ));

                echo $respuesta;
            }
        }
    }

?>