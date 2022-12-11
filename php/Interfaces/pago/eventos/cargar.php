<?php
    //Clases  de acceso a datos
    include_once(DAO_PATH.'/PagoDAO.php');
    //Funciones
    include_once(GENERAL_PATH.'/comprobarInput.php');

/*
    FALTA ALGUN METODO PARA DESACER LOS CAMBIOS DE HABER OCURRIDO ALGUN ERRROR
*/
    if( isset($_POST['cargar']) ) {
        $pagina = new Pagina(Pagina::PAGO);

        try { 
            //Comprobando los inputs
            $fecha = comprobarInput('fechaInput', $pagina);
            $claseInput = comprobarInput('montoInput', $pagina);
            $cedula = comprobarInput('cuentaInput', $pagina);

            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                //PERSONA
            $pagoDAO = new PagoDAO($bd);
            $pagoDAO->cargar(array($nombre, $apellido, $fecha, $claseInput, $cedula));

            $pagina->imprimirMensaje(null, Mensaje::EXITO, "Se ha cargado al pago exitosamente.");
        }
        catch(InputException $e) {
            $e->imprimirError();
        }
        catch(Exception $e) {  
            alerta($e);
        }
    }
?>