<?php
    include_once(DAO_PATH.'/PagoDAO.php');
    include_once(DAO_PATH.'/BaseDeDatos.php');
    include_once(GENERAL_PATH.'/Pagina.php');
    include_once(GENERAL_PATH.'/comprobarChecks.php');

    /*
        Consulta estudiantes dependiendo de la clase.
    */
    if( isset($_POST['validez']) ) {
        $pagina = new Pagina(Pagina::PAGO);

        try {  
            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
            $pagoDAO = new PagoDAO($bd);

            $pagoId = comprobarChecks(true, $pagina);
            $validez = $_POST['validezInput'];
            $validez = $validez==1 ? true : false;

            for($i=0; $i<count($pagoId); $i++) {
                $id = $pagoId[$i];
                $pagoDAO->validar(array($validez, $id));
            }

            if($validez==1) {
                $pagina->imprimirMensaje(null, Mensaje::EXITO, "Se validaron con exito");
            }
            else {
                $pagina->imprimirMensaje(null, Mensaje::EXITO, "Se invalidaron con exito");
            }
        }
        catch(Exception $e) {  //No se ha podido conectar a la bd
            $pagina->imprimirMensaje(null, Mensaje::ERROR, $e->getMessage());
        }
    }
?>