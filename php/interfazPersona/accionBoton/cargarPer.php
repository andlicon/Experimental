<?php
    include_once('../acciones/CargarPersona.php');
    //Clases  de acceso a datos
    include_once('../conexion/PersonaDAO.php');
    include_once('../conexion/ContactoDAO.php');
    //Funciones
    include_once('../formulario/Alerta.php');
    include_once('../general/crearCedula.php');
    include_once('../general/comprobarInput.php');
    include_once('../general/mandarMensaje.php');
/*
    consulta única instancia para Representante
*/

/*
    FALTA ALGUN METODO PARA DESACER LOS CAMBIOS DE HABER OCURRIDO ALGUN ERRROR
*/
    if( isset($_POST['cargar']) ) {
        $pagina = 'Location: personaView.php';

        //Comprobando los inputs
        $nacionalidadInput = comprobarInput('nacionalidadInput', 'Se debe introducir una nacionalidad valida', $pagina);
        $cedulaInput = comprobarInput('cedulaInput', 'Se debe introducir un numero de cedula valido', $pagina);
        $nombre = comprobarInput('nombreInput', 'Se debe introducir un nombre valido', $pagina);
        $apellido = comprobarInput('apellidoInput', 'Se debe introducir un apellido valido', $pagina);

        $cedula = crearCedula($nacionalidadInput, $cedulaInput);    //se crea la cedula

        try { 
            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                //PERSONA
            $personaDAO = new PersonaDAO($bd);

            $cargador = new CargarPersona($personaDAO, $contactoDAO);
            $cargador->cargar(array
                                    (
                                        array($cedula, $nombre, $apellido, 1),
                                        array($cedula, 1, $correo), 
                                        array($cedula, 2, $telefono)
                                    )
                            );

            $alerta = new Mensaje(null, true, 'se ha cargado exitosamente al representante');
            mandarMensaje($alerta, $pagina);
        }
        catch(Exception $e) {  
            alerta($e);
        }
    }
?>