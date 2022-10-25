<?php
    include_once('../conexion/contactoDAO.php');

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
                    $contactoDAO->cantidadContactos(array ($cedula)); //TENGO LA CANTIDAD DE CONTACTOS
                }
                //Primero elimina los contactos,
                    //De no existir otro contacto
                    //Elimiar idRepresentante
                    //despues las personas
    
            }
            catch(Exception $mensaje) {  
                alerta($mensaje);
            }
        }
    }

?>