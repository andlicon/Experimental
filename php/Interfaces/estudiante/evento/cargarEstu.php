<?php
    //Clases  de acceso a datos
    include_once(DAO_PATH.'/EstudianteDAO.php');
    //Funciones
    include_once(GENERAL_PATH.'/comprobarInput.php');

/*
    FALTA ALGUN METODO PARA DESACER LOS CAMBIOS DE HABER OCURRIDO ALGUN ERRROR
*/
    if( isset($_POST['cargar']) ) {
        $pagina = new Pagina(Pagina::ESTUDIANTE);

        try { 
            //Comprobando los inputs
            $nombre = comprobarInput('nombreInput', $pagina);
            $apellido = comprobarInput('apellidoInput', $pagina);
            $fecha = comprobarInput('fechaInput', $pagina);
            $claseInput = comprobarInput('claseInput', $pagina);
            $cedula = comprobarInput('representanteInput', $pagina);

            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                //PERSONA
            $estudianteDAO = new EstudianteDAO($bd);
            $estudianteDAO->cargar(array($nombre, $apellido, $fecha, $claseInput, $cedula));

            $bd->guardarCambios();
            $pagina->imprimirMensaje(null, Mensaje::EXITO, "Se ha cargado al estudiante exitosamente.");
        }
        catch(InputException $e) {
            $e->imprimirError();
        }
        catch(Exception $e) {  
            alerta($e);
        }
    }
?>