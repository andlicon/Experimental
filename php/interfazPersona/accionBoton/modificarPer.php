<?php
    include_once('../general/comprobarChecks.php');
    include_once('../general/Pagina.php');
    include_once('../Excepciones/ExceptionSelect.php');
    include_once('../formulario/Mensaje.php');

    if( isset($_POST['modificar']) ) {

        try {
            $pagina = new Pagina(Pagina::PERSONA);

            $cedulas = comprobarChecks(false, $pagina);
    
            //Inputs del usuario
            $nombre = $_POST['nombreInput'];
            $apellido = $_POST['apellidoInput'];

            $cedula = $cedulas[0];

            if($nombre!="" || $apellido!="") {
                $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                        
                $personaDAO = new PersonaDAO($bd);
    
                $personaDAO->modificar(array($nombre, $apellido, $cedula));

                $pagina->imprimirMensaje(null, Mensaje::EXITO, "Se ha modificado a la persona exitosamente.");
            }
            else {
                $pagina->imprimirMensaje(null, Mensaje::ERROR, "Para modificar se debe introducir al menos 1 dato");
            }
        }
        catch(ExceptionSelect $e) {
            echo $e->imprimirError();
        }
        catch(Exception $e) {
            echo $e;
        }

    }
?>