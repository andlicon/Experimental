<?php
    include_once('../acciones/CargarEstudiante.php');
    //Clases  de acceso a datos
    include_once('../conexion/PersonaDAO.php');
    include_once('../conexion/ContactoDAO.php');
    include_once('../conexion/RepresentanteConsul.php');
    //Funciones
    include_once('../formulario/Alerta.php');
    include_once('../general/comprobarInput.php');
    include_once('../general/mandarMensaje.php');

/*
    FALTA ALGUN METODO PARA DESACER LOS CAMBIOS DE HABER OCURRIDO ALGUN ERRROR
*/
    if( isset($_POST['cargar']) ) {
        $pagina = "Location: estudianteView.php";

        //Comprobando los inputs
        $claseInput = comprobarInput('claseInput', 'Se debe introducir una clase valida', $pagina);
        $nombre = comprobarInput('nombreInput', 'Se debe introducir un nombre valido', $pagina);
        $apellido = comprobarInput('apellidoInput', 'Se debe introducir un apellido valido', $pagina);
        $fecha = comprobarInput('fechaInput', 'Se debe introducir una fecha valida', $pagina);
        $cedulaRep = comprobarInput('cedulaRepInput', 'Se debe introducir una fecha valida', $pagina);

        try { 
            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                //PERSONA
            $estudianteDAO = new EstudianteDAO($bd);
            $representanteConsul = new RepresentanteConsul($bd);

            $cargador = new CargarEstudiante($estudianteDAO, $representanteConsul);
            $cargador->cargar(array
                                    (array($cedulaRep),
                                     array($nombre, $apellido, $fecha, $claseInput), 
                                    )
                            );
            $mensaje = new Mensaje(null, true, 'se ha cargado exitosamente al estudiante');
            mandarMensaje($mensaje, $pagina);
        }
        catch(Exception $e) {  
            alerta($e);
        }
    }
?>