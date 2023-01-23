<?php
    include_once('../rutaAcciones.php');
    include_once(DAO_PATH.'EstudianteDAO.php');
    include_once(DAO_PATH.'BaseDeDatos.php');

    class CargarDeuda {
        public function cargar() {

            // if( isset($_POST['nombre']) && 
            //     isset($_POST['apellido']) && isset($_POST['fecha']) && 
            //     isset($_POST['clase']) && isset($_POST['cedula'])
            // ) {
            //     $nombre = $_POST['nombre'];
            //     $apellido = $_POST['apellido'];
            //     $fecha = $_POST['fecha'];
            //     $clase = $_POST['clase'];
            //     $cedula = $_POST['cedula'];

            //     //Falta algo para validar los datos
            
            //     $estudianteDAO = new EstudianteDAO(BaseDeDatos::getInstancia());
            //     $estudianteDAO->cargar(array($nombre, $apellido, $fecha, $clase, $cedula));

            //     echo 'se ha cargado correctamente el estudiante.';
            // }
        }
    }

?>