<?php
    $pag = 'Location: RepresentanteView.php';

    if( isset($_POST['eliminar']) ) {
        if( isset($_POST['check']) ) {
            $checks = $_POST['check'];
            
            try {   //Extraer informacion de la base de datos
                $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                
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