<?php
    include_once(DAO_PATH.'/UsuarioDAO.php');
    include_once(GENERAL_PATH.'/crearCedula.php');
    include_once(GENERAL_PATH.'/comprobarInput.php');
    include_once(GENERAL_PATH.'/Pagina.php');

    /*
        consulta única instancia para Representante
    */
    if( isset($_POST['consultar']) ) {
        $pagina = new Pagina(Pagina::USUARIOS);

        try {   
            $tipoConsulta = comprobarInput('tipoConsulta', $pagina);

            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
            $usuarioDAO = new usuarioDAO($bd);

            if($tipoConsulta=="validos") {
                $resultado = $usuarioDAO->getInstanciaValidez(array(1));
            }
            else if($tipoConsulta=="invalidos") {
                $resultado = $usuarioDAO->getInstanciaValidez(array(0));
            }
            else {
                $resultado = $usuarioDAO->getTodos();
            }

            $pagina->actualizarPagina($resultado);
        }
        catch(InputException $e) {
            $e->imprimirError();
        }
        catch(Exception $e) {  //No se ha podido conectar a la bd
            echo $e;
        }
    }
?>