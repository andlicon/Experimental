<?php
    include_once(DAO_PATH.'/BaseDeDatos.php');
    include_once(DAO_PATH.'/ClaseConsul.php');
    include_once(DTO_PATH.'/Clase.php');
    include_once(DTO_PATH.'/Usuario.php');

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