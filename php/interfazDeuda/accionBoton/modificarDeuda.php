<?php
    include_once('../conexion/DeudaDAO.php');
    include_once('../conexion/BaseDeDatos.php');

    include_once('../general/crearCedula.php');
    include_once('../general/comprobarInput.php');

    if( isset($_POST['modificar']) ) {
        $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
        $pagina = new Pagina(Pagina::DEUDA);

        try {
            $idsDeudas = comprobarChecks(false, $pagina);

            $deudaDAO = new DeudaDAO($bd);

            //INPUTS
            $nacionalidadInput = $_POST['nacionalidadInput'];
            $cedulaNumInput = $_POST['cedulaInput'];
            $cedulaInput = $cedulaNumInput=="" ? "" : crearCedula($nacionalidadInput, $cedulaNumInput);
            $idMotivoInput = $_POST['motivoInput'];
            $descripcionInput = $_POST['descripcionInput'];
            $fechaInput = $_POST['fechaInput'];
            $montoInput = $_POST['montoInput'];

            for($i=0; $i<count($idsDeudas); $i++) {
                $idDeuda = $idsDeudas[$i];
                $deudas = $deudaDAO->getInstancia(array($idDeuda));
                $deuda = $deudas[0];

                $cedula = $cedulaInput=="" ? $deuda->getCedula() : $cedulaInput;
                $idMotivo = $idMotivoInput=="" ? $deuda->getIdMotivo() : $idMotivoInput;
                $descripcion = $descripcionInput=="" ? $deuda->getDescripcion() : $descripcionInput;
                $fecha = $fechaInput=="" ? $deuda->getFecha() : $fechaInput;
                $monto = $montoInput=="" ? $deuda->getMontoInicial() : $montoInicial;

                $deudaDAO->modificar( array($cedula, $idMotivo, $fecha, 
                                            $descripcion, $monto, $idDeuda));

                $bd->guardarCambios();
            }

            $pagina->imprimirMensaje(null, Mensaje::EXITO, "La deuda fue modificada con exito.");
        }
        catch(ExceptionSelect $e) {
            echo $e->imprimirError();
        }
        catch(PDOException $e) {
            $codigo = $e->getCode();

            if($codigo==23000) {
                $bd->revertirCambios();
                $pagina->imprimirMensaje(null, Mensaje::ERROR, "Existe alguna dependencia que impide eliminar a la persona.");

                die();
            }
            
            echo $e;
        }
        catch(Exception $e) {
            echo $e;
        }
    }
?>