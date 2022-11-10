<?php
    include_once('../conexion/ContactoDAO.php');
    include_once('../conexion/PersonaDAO.php');
    include_once('../acciones/EliminarPersona.php');

    if( isset($_POST['eliminar']) ) {

        try {
            $pagina = new Pagina(Pagina::PERSONA);

            $cedulas = comprobarChecks(true, $pagina);

            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
            $contactoDAO = new ContactoDAO($bd);
            $personaDAO = new PersonaDAO($bd);

            for($i=0; $i<count($cedulas); $i++) {
                $cedula = $cedulas[$i];

                $personaDAO->eliminar(array($cedula));
                $contactoDAO->eliminarPorCedula(array($cedula));
            }
        }
        catch(ExceptionSelect $e) {
            echo $e->imprimirError();
        }
        catch(Exception $e) {
            echo $e;
        }


        try {   //Extraer informacion de la base de datos
            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
            $contactoDAO = new ContactoDAO($bd);
            $personaDAO = new PersonaDAO($bd);

            $eliminador = new EliminarPersona($personaDAO, $contactoDAO);

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


        if( isset($_POST['check']) ) {
        

            try {   //Extraer informacion de la base de datos
                $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                $contactoDAO = new ContactoDAO($bd);
                $personaDAO = new PersonaDAO($bd);

                $eliminador = new EliminarPersona($personaDAO, $contactoDAO);

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