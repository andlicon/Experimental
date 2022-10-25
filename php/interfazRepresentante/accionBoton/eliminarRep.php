<?php
    include_once('../conexion/ContactoDAO.php');
    include_once('../conexion/PersonaDAO.php');

    $pag = 'Location: RepresentanteView.php';

    if( isset($_POST['eliminar']) ) {
        if( isset($_POST['check']) ) {
            $checks = $_POST['check'];

            try {   //Extraer informacion de la base de datos
                $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                $contactoDAO = new ContactoDAO($bd);

                for($i=0; $i<count($checks); $i++) {
                    $datos = explode(',', $checks[$i]);
                    $cedula = $datos[0];
                    $tipoContacto = $datos[1];
                    $cantidadContacto = $contactoDAO->cantidadContactos(array ($cedula)); //TENGO LA CANTIDAD DE CONTACTOS

                    if( $cantidadContacto > 1 ) {
                        //Solo se elimina el contacto
                        $contactoDAO->eliminar(array($cedula, $tipoContacto));
                    }
                    else {
                        $contactoDAO->eliminar(array($cedula, $tipoContacto));
                        //Eliminar id_representante
                        $repModif = new Representante($bd);
                        $repModif->eliminar($cedula);
                        //Eliminar persona
                        $personaDAO = new PersonaDAO($bd);
                        $personaDAO->eliminar($cedula);
                    }
                }
    
            }
            catch(Exception $mensaje) {  
                alerta($mensaje);
            }
        }
    }

?>