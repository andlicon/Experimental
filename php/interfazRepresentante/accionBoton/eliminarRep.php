<?php
    $pag = 'Location: RepresentanteView.php';

    if( isset($_POST['eliminar']) ) {
        $nacionalidadInput = comprobarInput('nacionalidadInput', 'Se debe introducir una nacionalidad valida', $pagina);
        $cedulaInput = comprobarInput('cedulaInput', 'Se debe introducir un numero de cedula valido', $pagina);

        $cedula = crearCedula($nacionalidadInput, $cedulaInput);

        try {   //Extraer informacion de la base de datos
            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
            $representanteConsul = new RepresentanteConsul($bd);
            $representante= $representanteConsul->getInstancia(array($cedula));
            
            //borrar representante
            //borrar persona
            //borrar contacto


            $mensaje = new Mensaje(null, true, 'se ha eliminado con exito el representante');
            $serialize = serialize($mensaje);
            header("$pag?mensaje=".urlencode($serialize));
        }
        catch(Exception $mensaje) {  
            alerta($mensaje);
        }
    }

?>