<?php
    include_once('../conexion/BaseDeDatos.php');
    include_once('../conexion/ClaseConsul.php');
    include_once('../instancias/Clase.php');
    include_once('../instancias/Usuario.php');

    function getIdClase() {
        if(isset($_GET['usuario'])) {
            $usuarioGet = $_GET['usuario'];
            $usuario = unserialize($usuarioGet);

            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
            $claseConsul = new ClaseConsul($bd);

           $resultado = $claseConsul->getInstanciaProfesor(array($usuario->getCedula()));
            
            if($resultado!=null) {
                 return $resultado[0]->getId();
            }
        }
    }
?>