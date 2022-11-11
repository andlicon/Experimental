<?php
    include_once('../conexion/DeudaDAO.php');
    include_once('../conexion/BaseDeDatos.php');

    include_once('../general/crearCedula.php');
    include_once('../general/comprobarInput.php');

    if( isset($_POST['modificar']) ) {
        if( isset($_POST['check']) ) {
            $pagina = "Location: deudaView.php";
            $objSerializar = "deudas";

            $checks = $_POST['check'];

            if(count($checks)==1) {
                $nacionalidadInput = $_POST['nacionalidadInput'];
                $cedulaNumInput = $_POST['cedulaInput'];
                $cedulaInput = $cedulaNumInput=="" ? "" : crearCedula($nacionalidadInput, $cedulaNumInput);
                $idMotivoInput = $_POST['motivoInput'];
                $descripcionInput = $_POST['descripcionInput'];
                $fechaInput = $_POST['fechaInput'];
                $montoInput = $_POST['montoInput'];

                try {   //Extraer informacion de la base de datos
                    $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                    $deudaDAO = new DeudaDAO($bd);

                    for($i=0; $i<count($checks); $i++) {
                        $idDeuda = $checks[$i];
                        $deudas = $deudaDAO->getInstancia(array ($idDeuda));
                        $deuda = $deudas[0];

                        $cedula = $cedulaInput=="" ? $deuda->getCedula() : $cedulaInput;
                        $idMotivo = $idMotivoInput=="" ? $deuda->getMotivo()->getId() : $idMotivoInput;
                        $descripcion = $descripcionInput=="" ? $deuda->getDescripcion() : $descripcionInput;
                        $fecha = $fechaInput=="" ? $deuda->getFecha() : $fechaInput;
                        $monto = $montoInput=="" ? $deuda->getMontoInicial() : $montoInicial;

                        $deudaDAO->modificar( array($cedula, $idMotivo, $fecha, 
                                                    $descripcion, $monto, $idDeuda));
                    }
                
                    header($pagina);
                }
                catch(Exception $mensaje) {  
                    alerta($mensaje);
                }
            }
            else {
                $mensaje = new Mensaje(null, false, "se debe elegir 1 solo representante para modificar");
                mandarMenasje($mensaje, $pagina);
            }
        }
    }

?>