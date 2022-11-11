<?php
    include_once('../conexion/BaseDeDatos.php');
    include_once('../conexion/DeudaDAO.php');
    
    include_once('../general/crearCedula.php');
    include_once('../general/comprobarInput.php');
    include_once('../general/crearCedula.php');
    include_once('../general/Pagina.php');

    if( isset($_POST['consultarCedula']) ) {
        $pagina = new Pagina(Pagina::DEUDA);

            try {
                //INPUTS
                $nacionalidadInput = comprobarInput('nacionalidadInput', $pagina);
                $cedulaInput = comprobarInput('cedulaInput', $pagina);
                $cedula = crearCedula($nacionalidadInput, $cedulaInput);

                $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                $deudaDAO = new DeudaDAO($bd);

                $resultado = $deudaDAO->getInstanciaCedula(array($cedula));

                $pagina->actualizarPagina($resultado);
            }
            catch(InputException $e) {
                $e->imprimirError();
            }
            catch(Exception $e) {   //De no conectarse a la bd
                echo $e;
            }
    }
?>