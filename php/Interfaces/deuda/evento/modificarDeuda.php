<?php
    include_once(DAO_PATH.'/DeudaDAO.php');
    include_once(DAO_PATH.'/BaseDeDatos.php');

    include_once(GENERAL_PATH.'/crearCedula.php');
    include_once(GENERAL_PATH.'/comprobarInput.php');

    if( isset($_POST['modificar']) ) {
        $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
        $pagina = new Pagina(Pagina::DEUDA);

        try {
            $idsDeudas = comprobarChecks(false, $pagina);

            $deudaDAO = new DeudaDAO($bd);

            //INPUTS
            $idEstudianteInput = $_POST['estudianteInput'];
            $idMotivoInput = $_POST['motivoInput'];
            $descripcionInput = $_POST['descripcionInput'];
            $fechaInput = $_POST['fechaInput'];
            $montoInput = $_POST['montoInicialInput'];

            for($i=0; $i<count($idsDeudas); $i++) {
                $idDeuda = $idsDeudas[$i];
                $deudas = $deudaDAO->getInstancia(array($idDeuda));
                $deuda = $deudas[0];

                $idMotivo = $idMotivoInput=="" ? $deuda->getIdMotivo() : $idMotivoInput;
                $descripcion = $descripcionInput=="" ? $deuda->getDescripcion() : $descripcionInput;
                $fecha = $fechaInput=="" ? $deuda->getFecha() : $fechaInput;
                $monto = $montoInput=="" ? $deuda->getMontoInicial() : $montoInput;

                $idEstudiante = "";
                $cedulaRep = "";
                if($idEstudianteInput == "") { 
                    $idEstudiante = $deuda->getIdEstudiante();
                    $cedulaRep = $deuda->getCedula();
                }
                else {
                    $idEstudiante = $idEstudianteInput;

                    $estudianteDAO = new EstudianteDAO($bd);
                    $resultado = $estudianteDAO->getInstancia(array($idEstudiante));
                    $cedulaRep = $resultado[0]->getCedulaRepresentante();
                }

                $deudaDAO->modificar( array($cedulaRep, $idEstudiante, $idMotivo, $fecha, 
                                            $descripcion, $monto, $idDeuda));
            }

            $pagina->imprimirMensaje(null, Mensaje::EXITO, "La deuda fue modificada con exito.");
        }
        catch(SelectException $e) {
            $e->imprimirError();
        }
        catch(PDOException $e) {
            $codigo = $e->getCode();

            if($codigo==23000) {
                $bd->revertirCambios();
                $pagina->imprimirMensaje(null, Mensaje::ERROR, "Existe alguna dependencia que impide modificar a la deuda.");
        
                die();
            }
            
            echo $e;
        }
        catch(Exception $e) {
            echo $e;
        }
    }
?>