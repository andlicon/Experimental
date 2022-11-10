<?php
    //Clases  de acceso a datos
    include_once('../conexion/PersonaDAO.php');
    include_once('../conexion/ContactoDAO.php');
    //Funciones
    include_once('../general/comprobarInput.php');
    include_once('../general/mandarMensaje.php');
    include_once('../general/formatoFecha.php');

/*
    FALTA ALGUN METODO PARA DESACER LOS CAMBIOS DE HABER OCURRIDO ALGUN ERRROR
*/
    if( isset($_POST['cargar']) ) {
        $pagina = "Location: estudianteView.php";

        //Comprobando los inputs
        $nombre = comprobarInput('nombreInput', $pagina);
        $apellido = comprobarInput('apellidoInput', $pagina);
        $fecha = comprobarInput('fechaInput', $pagina);
        $claseInput = comprobarInput('claseInput', $pagina);
        $nacionalidadInput = comprobarInput('nacionalidadInput', $pagina);
        $cedulaInput = comprobarInput('cedulaInput', $pagina);

        $cedula = crearCedula($nacionalidadInput, $cedulaInput);

        try { 
            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                //PERSONA
            $estudianteDAO = new EstudianteDAO($bd);
            $estudianteDAO->cargar(array($nombre, $apellido, $fecha, $claseInput, $cedula));

            $mensaje = new Mensaje(null, true, 'se ha cargado exitosamente al estudiante');
            mandarMensaje($mensaje, $pagina);
        }
        catch(Exception $e) {  
            alerta($e);
        }
    }
?>