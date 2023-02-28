<?php
    include_once('../../accion/rutaAcciones.php');
    include_once(DAO_PATH.'BaseDeDatos.php');
    include_once(DAO_PATH.'MotivoConsul.php');
    include_once(DAO_PATH.'EstudianteDAO.php');
    include_once(DAO_PATH.'ClaseConsul.php');
    include_once(DAO_PATH.'MovimientoConsul.php');
    include_once(DAO_PATH.'DeudaDAO.php');
    include_once(DAO_PATH.'PagoDAO.php');
    include_once(DAO_PATH.'TipoPagoConsul.php');
    include_once(DAO_PATH.'CuentaConsul.php');

    if(isset($_POST['cedula'])) {
        $cedula = $_POST['cedula'];

        $tabla = "
        <div class=\"tabla\">
            <h2 class=\"tabla__titulo\">Movimientos</h2>
            <table class=\"tabla__table\">
                <thead>
                    <tr class=\"tabla__tr\">
                        <th class=\"tabla__td tabla__th\">Referencia</th>
                        <th class=\"tabla__td tabla__th\">Fecha</th>
                        <th class=\"tabla__td tabla__th\">Descripcion</th>
                        <th class=\"tabla__td tabla__th\">Monto</th>
                    </tr>
                </thead>
                <tbody>";

        try {
            $movimientoConsul = new MovimientoConsul(BaseDeDatos::getInstancia());
            $resultados = $movimientoConsul->getInstancia(array($cedula));
    
            for($i=0; $i<count($resultados); $i++) {
                $movimiento = $resultados[$i];
                $referencia = $movimiento->getReferencia();
                $fecha = $movimiento->getFecha();
                $descripcion = $movimiento->getDescripcion();
                $monto = $movimiento->getMonto();
                $classMonto = $monto>0 ? "tabla__td--ingresos" : "tabla__td--deuda";

                $modal = "";
                $trigger = "";

                if(str_contains($referencia,"P")) {
                    $referencia = str_replace("P", "", $referencia);
                    //Consultar info
                    $pagoDAO = new PagoDAO(BaseDeDatos::getInstancia());
                    $resultado = $pagoDAO->getInstancia(array($referencia));
                    $pago = $resultado[0];
                    $pagoId = $referencia;

                    $idDeuda = $pago->getIdDeuda();
                    $deudaId = $pago->getIdDeuda();
                    $fechaPago = $pago->getFecha();
                    $cedulaPago = $pago->getCedula();
                    $montoPago = $pago->getMonto();
                    $referenciaPago = $pago->getRef();

                    //Cuenta
                    $idCuenta = $pago->getIdCuenta();
                    $cuentaConsul = new CuentaConsul(BaseDeDatos::getInstancia());
                    $cuentaDescripcion = $cuentaConsul->getInstancia(array($idCuenta))[0]->getDescripcion();

                    //tipoPago
                    $idCuentaPago = $pago->getIdTipoPago();
                    $tipoPago = new TipoPagoConsul(BaseDeDatos::getInstancia());
                    $tipoPagoDescrip = $tipoPago->getInstancia(array($idCuentaPago))[0]->getDescripcion();


                    $trigger = $referencia;

                    $trigger = "<a id=\"p$pagoId\" href=\"#exP$pagoId\" rel=\"modal:open\" class=\"popOver__trigger\">P$pagoId</a>";

                    $modal = "<div id=\"exP$pagoId\" class=\"modal\">
                                <h4 class=\"popOver__informacion popOver__elemento\">Informacion Pago</h4>
                                <p class=\"popOver__elemento\"><span class=\"negrita\">Cedula:</span> $cedulaPago</p>
                                <p class=\"popOver__elemento\"><span class=\"negrita\">Referencia deuda: </span> <a id=\"deuda$deudaId\" href=\"#ex$deudaId\" rel=\"modal:open\" class=\"popOver__trigger\">D$idDeuda</a></p>
                                <p class=\"popOver__elemento\"><span class=\"negrita\">Fecha:</span> $fechaPago</p>
                                <p class=\"popOver__elemento\"><span class=\"negrita\">Tipo pago: </span> $tipoPagoDescrip</p>
                                <p class=\"popOver__elemento\"><span class=\"negrita\">Cuenta: </span> $cuentaDescripcion</p>
                                <p class=\"popOver__elemento\"><span class=\"negrita\">Referencia pago: </span> $referenciaPago</p>
                                <p class=\"popOver__elemento\"><span class=\"negrita\">Monto pagado: </span> $montoPago</p>
                            </div>";
                }
                else {
                    $referencia = str_replace("D", "", $referencia);
                    //Consultar info
                    $deudaDAO = new DeudaDAO(BaseDeDatos::getInstancia());
                    $resultado = $deudaDAO->getInstancia(array($referencia));
                    $deuda = $resultado[0];

                    //deuda
                    $deudaId = $deuda->getId();
                    $cedula = $deuda->getCedula();
                    $idEstudiante = $deuda->getIdEstudiante();
                    $fecha = $deuda->getFecha();
                    $montoInicial = $deuda->getMontoInicial();
                    $idMotivo = $deuda->getidMotivo();

                    //Motivo
                    $motivoConsul = new MotivoConsul(BaseDeDatos::getInstancia());
                    $resultado = $motivoConsul->getInstancia(array($idMotivo));
                    $motivo = $resultado[0]->getDescripcion();

                    //Estudiante
                    $estudianteDAO = new EstudianteDAO(BaseDeDatos::getInstancia());
                    $resultado = $estudianteDAO->getInstancia(array($idEstudiante));
                    $estudianteNombre = $resultado[0]->getNombre();
                    $apellidoEstudiante = $resultado[0]->getApellido();
                    $idClaseEstudiante = $resultado[0]->getIdClase();
                    $cedulaRepEstudiante = $resultado[0]->getCedulaRepresentante();
                    $lugarNacimientoEstudiante = $resultado[0]->getLugarNacimiento();
                    $fechaEstudiante = $resultado[0]->getFechaNacimiento();

                    $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                    $claseConsul = new ClaseConsul($bd);
                    $claseNombre = null;

                    if($idClaseEstudiante!=null) {
                        $resultado = $claseConsul->getInstancia(array($idClaseEstudiante));
                        $clase = $resultado[0];
                        $claseNombre = $clase->getDescripcion();
                    }
        
                    $claseNombre = $claseNombre==null ? "Sin asignar" : $claseNombre;

                    //trigger
                    $trigger = "<a id=\"deuda$deudaId\" href=\"#ex$deudaId\" rel=\"modal:open\" class=\"popOver__trigger\">D$referencia</a>";

                    //crear modal
                    $modal = "<div id=\"ex$deudaId\" class=\"modal\">
                                <h4 class=\"popOver__informacion popOver__elemento\">Informacion deuda</h4>
                                <p class=\"popOver__elemento\"><span class=\"negrita\">Cedula:</span> $cedula</p>
                                <p class=\"popOver__elemento\"><span class=\"negrita\">Estudiante:</span> <a id=\"estudiante$deudaId\" href=\"#ex$deudaId$idEstudiante\" rel=\"modal:open\" class=\"popOver__trigger\">$estudianteNombre</a></p>
                                <p class=\"popOver__elemento\"><span class=\"negrita\">Fecha:</span> $fecha</p>
                                <p class=\"popOver__elemento\"><span class=\"negrita\">Monto Inicial:</span> $montoInicial</p>
                                <p class=\"popOver__elemento\"><span class=\"negrita\">Motivo:</span> $motivo</p>
                            </div>
                            <div id=\"ex$deudaId$idEstudiante\" class=\"modal\">
                                <h4 class=\"popOver__informacion popOver__elemento\">Informacion Estudiante</h4>
                                <p class=\"popOver__elemento\"><span class=\"negrita\">Nombre:</span> $estudianteNombre</p>
                                <p class=\"popOver__elemento\"><span class=\"negrita\">Apellido:</span> $apellidoEstudiante</p>
                                <p class=\"popOver__elemento\"><span class=\"negrita\">Fecha nacimiento:</span> $fechaEstudiante </p>
                                <p class=\"popOver__elemento\"><span class=\"negrita\">Lugar nacimiento:</span> $lugarNacimientoEstudiante</p>
                                <p class=\"popOver__elemento\"><span class=\"negrita\">Clase inscrito:</span> $claseNombre</p>
                                <p class=\"popOver__elemento\"><span class=\"negrita\">Cédula representante:</span> $cedulaRepEstudiante</p>
                            </div>
                    ";
                    
                }
    
                $fila = "
                     <tr class=\"tabla__tr\">
                         <td class=\"tabla__td\">$trigger</td>
                         <td class=\"tabla__td\">$fecha</td>
                         <td class=\"tabla__td\">$descripcion</td>
                         <td class=\"tabla__td $classMonto\">$monto</td>
                         $modal
                     </tr>";

        
                $tabla = $tabla.$fila;
    
            }
        }
        catch(Exception $e) {
            /*
            *    Tanto los <tr></tr> de respuesta como posibles errores (como lo es este caso) deberían
            *    ser JSON para así poder manejar mejor el error en JQUERY.
            *    Por cómo está hecho, acá no puedo hacer ningún aviso de error.
            */
        }
        finally {
            echo $tabla;
        }
    }

?>