<?php
    include_once('../conexion/DeudaDAO.php');

    if( isset($_POST['eliminar']) ) {
        if( isset($_POST['check']) ) {
            $checks = $_POST['check'];

            $pag = 'Location: DeudaView.php';

            try {   //Extraer informacion de la base de datos
                $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                $deudaDAO = new DeudaDAO($bd);

                for($i=0; $i<count($checks); $i++) {
                    $idDeuda = $checks[$i];

                    echo 'a';

                    $deudaDAO->eliminar(array($idDeuda));
                }
    
                header($pag);
            }
            catch(Exception $mensaje) {  
                alerta($mensaje);
            }
        }
    }

?>