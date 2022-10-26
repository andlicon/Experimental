<?php
    include_once('../conexion/ContactoDAO.php');
    include_once('../conexion/PersonaDAO.php');
    include_once('../conexion/RepresentanteModif.php');
    include_once('../acciones/EliminarRepresentante.php');

    if( isset($_POST['eliminar']) ) {
        if( isset($_POST['check']) ) {
            $checks = $_POST['check'];

            $pag = 'Location: RepresentanteView.php';

            try {   //Extraer informacion de la base de datos
                $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                $contactoDAO = new ContactoDAO($bd);
                $repModif = new RepresentanteModif($bd);
                $personaDAO = new PersonaDAO($bd);

                $eliminador = new EliminarRepresentante($personaDAO, $contactoDAO, $repModif);

                for($i=0; $i<count($checks); $i++) {
                    $datos = explode(',', $checks[$i]);
                    $cedula = $datos[0];
                    $tipoContacto = $datos[1];

                    $eliminador->eliminar(array (
                                                array($cedula, $tipoContacto),
                                                array($cedula)
                                         ));
                }
    
                header($pag);
            }
            catch(Exception $mensaje) {  
                alerta($mensaje);
            }
        }
    }

?>


<!-- $cantidadContacto = $contactoDAO->cantidadContactos(array ($cedula)); //TENGO LA CANTIDAD DE CONTACTOS

if( $cantidadContacto > 1 ) {
    //Solo se elimina el contacto
    $contactoDAO->eliminar(array($cedula, $tipoContacto));
}
else {
    $contactoDAO->eliminar(array($cedula, $tipoContacto));
    //Eliminar id_representante
    $repModif = new RepresentanteModif($bd);
    $repModif->eliminar(array ($cedula));
    //Eliminar persona
    $personaDAO = new PersonaDAO($bd);
    $personaDAO->eliminar(array($cedula));
} -->