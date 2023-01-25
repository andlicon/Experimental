<?php
    include_once('../../accion/rutaAcciones.php');
    include_once(DAO_PATH.'/BaseDeDatos.php');
    include_once(DAO_PATH.'/DeudaDAO.php');
    include_once(DAO_PATH.'/EstudianteDAO.php');

    if(isset($_POST['fecha'])) {
        $fecha = $_POST['fecha'];
        $html = "<div class=\"tabla\">
                    <h2>Deuda aún vigente del ciclo por representante</h2>";

        $deudaDAO = new DeudaDAO(BaseDeDatos::getInstancia());

        try {
            if($fecha!=null) {
                $fecha = explode("-", $fecha);
                $anio = $fecha[0];
                $mes = $fecha[1];
    
                $registros = $deudaDAO->getDeficitDetalladoDeudor(array($anio, $mes));
                echo "hay ".count($registros);
            }
            else {
                $registros = $deudaDAO->getDeficitDetalladoHistorico();
            }

            $estudianteDAO = new EstudianteDAO(BaseDeDatos::getInstancia());

            //Comparadores
            $representanteAux = "";
            $tablaAux = "";
            $estudianteRow = "";
            $tablaAux = "";
            //Contadores
            $pagoTotalRep = 0;
            $deudaTotalRep = 0;
            $deficitTotal = 0;

            //Retorna la tabla deficit
            for($i=0; $i<count($registros); $i++) {
                $deuda = $registros[$i];
                $representante = $deuda->getCedula();
                $idEstudiante = $deuda->getIdEstudiante();
                $montoInicial = $deuda->getMontoInicial();
                $montoEstado = $deuda->getMontoEstado();
                $deficit = $deuda->getDeuda() * -1;

                //Info estudiante
                $estudianteResul = $estudianteDAO->getInstancia(array($idEstudiante));
                $estudiante = $estudianteResul[0];
                $estudiante = $estudiante->getNombre().' '.$estudiante->getApellido();

                //Info
                $estudianteRow = $estudianteRow."
                <tr>
                    <td>$estudiante</td>
                    <td>$montoInicial</td>
                    <td>$montoEstado</td>
                    <td>$deficit</td>
                </tr>";
            
                $deudaTotalRep = $deudaTotalRep + $montoInicial;
                $pagoTotalRep = $pagoTotalRep + $montoEstado;
                $deficitTotal = $pagoTotalRep - $deudaTotalRep;

                //Es el mismo representante?
                if($i==count($registros)-1 || strcmp($representanteAux, $representante) != 0){
                    //info rep acumulada
                    $representanteAux = $representanteAux=="" ? $representante : $representanteAux;
                    $tablaAux = "<table class=\"tabla__table\">
                                    </thead>
                                        <caption>
                                            Representante: $representanteAux
                                        </caption>
                                        <tr class=\"tabla__tr\">
                                            <th class=\"tabla__td tabla__th\">Estudiante</th>
                                            <th class=\"tabla__td tabla__th\">Deuda generada</th>
                                            <th class=\"tabla__td tabla__th\">Monto Pagado</th>
                                            <th class=\"tabla__td tabla__th\">Deficit</th>
                                        </tr>
                                    </thead>
                                    <tbody>".
                                    $estudianteRow
                                    ."  
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td>TOTAL</td>
                                            <td>$deudaTotalRep</td>
                                            <td>$pagoTotalRep</td>
                                            <td>$deficitTotal</td>
                                        </tr>
                                    </tfoot>
                                </table>";
                    //Imprimir informacion acumulada
                    $html = $html.$tablaAux;
                    //Reiniciar
                    $tablaAux = "";
                    $estudianteRow = "";
                    $deudaTotalRep = 0;
                    $pagoTotalRep = 0;
                    $deficitTotal = 0;
                }

                $representanteAux = $representante;
            }
        }
        catch(Exception $e) {
            echo 'error';
        }

        echo $html."</div>";
    }
?>