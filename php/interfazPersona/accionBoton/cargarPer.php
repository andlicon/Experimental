<?php
    //Clases  de acceso a datos
    include_once('../conexion/PersonaDAO.php');
    include_once('../conexion/ContactoDAO.php');
    //Funciones
    include_once('../formulario/Alerta.php');
    include_once('../general/crearCedula.php');
    include_once('../general/comprobarInput.php');
    include_once('../excepciones/InputException.php');
/*
    consulta única instancia para Representante
*/

/*
    FALTA ALGUN METODO PARA DESACER LOS CAMBIOS DE HABER OCURRIDO ALGUN ERRROR
*/
    if( isset($_POST['cargar']) ) {
        $pagina = new Pagina(Pagina::PERSONA);

        try { 
            //Comprobando los inputs
            $nacionalidadInput = comprobarInput('nacionalidadInput', $pagina);
            $cedulaInput = comprobarInput('cedulaInput', $pagina);
            $cedula = crearCedula($nacionalidadInput, $cedulaInput);    //se crea la cedula
            $nombre = comprobarInput('nombreInput', $pagina);
            $apellido = comprobarInput('apellidoInput', $pagina);

            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
            
            $personaDAO = new PersonaDAO($bd);
            $personaDAO->cargar(array($cedula, $nombre, $apellido));

            $bd->guardarCambios();
            $pagina->imprimirMensaje(null, Mensaje::EXITO, "Se ha cargado a la persona exitosamente.");
        }
        catch(InputException $e) {
            $e->imprimirError();
        }
        catch(Exception $e) {  
            echo $e;
        }
    }
?>