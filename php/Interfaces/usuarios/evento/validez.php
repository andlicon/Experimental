<?php
    include_once(DAO_PATH.'/UsuarioDAO.php');
    include_once(GENERAL_PATH.'/crearCedula.php');
    include_once(GENERAL_PATH.'/comprobarInput.php');
    include_once(GENERAL_PATH.'/comprobarChecks.php');
    include_once(GENERAL_PATH.'/Pagina.php');

    /*
        consulta única instancia para Representante
    */
    if( isset($_POST['validez']) ) {
        $pagina = new Pagina(Pagina::USUARIOS);

        try {   
            $validezInput = $_POST['validezInput'];
            $cedulas = comprobarChecks(true, $pagina);

            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
            $usuarioDAO = new usuarioDAO($bd);


            for($i=0; $i<count($cedulas); $i++) {
                $cedula = $cedulas[$i];

                if($validezInput) {
                    $resultado = $usuarioDAO->modificarValidez(array(true, $cedula));
                }
                else {
                    $resultado = $usuarioDAO->modificarValidez(array(false, $cedula));
                }
            }

            $pagina->imprimirMensaje(null, Mensaje::EXITO, "Se ha asignado $validezInput a los usuarios Exitosamente.");
        }
        catch(SelectException $e) {
            $pagina->imprimirMensaje(null, Mensaje::ERROR, $e->getMessage());
        }
        catch(InputException $e) {
            $e->imprimirError();
        }
        catch(Exception $e) {  //No se ha podido conectar a la bd
            echo $e;
        }
    }
?>