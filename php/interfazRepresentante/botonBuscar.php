<?php
    include_once('../instancias/Representante.php');
    include_once('../conexion/RepresentanteDAO.php');
    include_once('../formulario/Alerta.php');
    include_once('../general/crearCedula.php');

    if( isset($_POST['buscar']) ) {
        //Cedula introducida por el usuario
        $cedula = crearCedula();

        try {   //Extraer informacion de la base de datos
            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
            $representanteDAO = new RepresentanteDAO($bd);
            //Esto lo quiero hacer mejor
            //$representante = $representanteDAO->getInstancia(array($cedula));
            $representante = $representanteDAO->getTodos();
        }
        catch(Exception $mensaje) {  
            alerta($mensaje);
        }
    }

    function botonRepresentante(IDAO $idao) {
        
    }
?>




