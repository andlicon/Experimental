<?php
    //Clases  de acceso a datos
    include_once(DAO_PATH.'/ContactoDAO.php');
    //Funciones
    include_once(GENERAL_PATH.'/crearCedula.php');
    include_once(GENERAL_PATH.'/comprobarInput.php');

    include_once(EXCEPTION_PATH.'/InputException.php');
/*
    consulta única instancia para Representante
*/

/*
    FALTA ALGUN METODO PARA DESACER LOS CAMBIOS DE HABER OCURRIDO ALGUN ERRROR
*/
    if( isset($_POST['cargar']) ) {
        $pagina = new Pagina(Pagina::CONTACTO);

        try { 
            //Comprobando los inputs
            $nacionalidadInput = comprobarInput('nacionalidadInput', $pagina);
            $cedulaInput = comprobarInput('cedulaInput', $pagina);
            $cedula = crearCedula($nacionalidadInput, $cedulaInput);    //se crea la cedula
            $correo = comprobarInput('correoInput', $pagina);
            $telefono = $_POST['telefonoInput'];

            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
    
            $contactoDAO = new ContactoDAO($bd);

            if($contactoDAO->cantidadContactos(array($cedula))<2) {
                $contactoDAO->cargar(array($cedula, 1, $correo));

                if($telefono!="") {
                    $contactoDAO->cargar(array($cedula, 2, $telefono));
                }

                $bd->guardarCambios();
                $pagina->imprimirMensaje(null, Mensaje::EXITO, "Se ha cargado el contacto exitosamente.");
            }
            else {
                $pagina->imprimirMensaje(null, Mensaje::ERROR, "La persona no puede tener mas contactos.");
            }
        }
        catch(InputException $e) {
            $e->imprimirError();
        }
        catch(Exception $e) {  
            echo $e;
        }
    }
?>