<?php
    include_once('../acciones/Actualizar.php');
    include_once('../conexion/BaseDeDatos.php');
    include_once('../conexion/ProfesorConsul.php');
    include_once('../general/comprobarInput.php');
    include_once('../general/crearCedula.php');
    include_once('../acciones/Consultar.php');

    if( isset($_POST['consultar']) ) {
        $pagina = new Pagina(Pagina::PROFESOR);
        
        //Cedula introducida por el usuario
        try {
            $nacionalidadInput = comprobarInput('nacionalidadInput', $pagina);
            $cedulaInput = comprobarInput('cedulaInput', $pagina);
            $cedula = crearCedula($nacionalidadInput, $cedulaInput);

            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
            $profConsul = new ProfesorConsul($bd);

            $resultado = $profConsul->getInstancia(array($cedula));
            $pagina->actualizarPagina($resultado);
        }
        catch(InputException $e) {
            $e->imprimirError();
        }
        catch(Exception $e) {   //De no conectarse a la bd
            $pagina->imprimirMensaje(null, Mensaje::ERROR, "No hay representante");
        }
    }
?>