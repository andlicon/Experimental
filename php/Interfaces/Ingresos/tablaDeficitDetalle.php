<?php
    include_once('../../accion/rutaAcciones.php');
    include_once(DAO_PATH.'/BaseDeDatos.php');
    include_once(DAO_PATH.'/DeudaDAO.php');

    if(isset($_POST['fecha'])) {
        $fecha = $_POST['fecha'];
        $html = "<div class=\"tabla\">
                    <h2>Deuda por representante</h2>";

        if($fecha!=null) {
            $anio = "";
            $mes = "";

            try {
                //Separa la info del front
                $fecha = explode("-", $fecha);
                $anio = $fecha[0];
                $mes = $fecha[1];
                //Comparadores
                $representanteAux = "";
                $tablaAux = "";
                $estudianteRow = "";
                $tablaAux = "";
                //Contadores
                $pagoTotalRep = 0;
                $deudaTotalRep = 0;
                $deficitTotal = 0;
                //consultar deficit a la base de datos para el mes aca indicado
                $deudaDAO = new DeudaDAO(BaseDeDatos::getInstancia());
                $registros = $deudaDAO->getDeficitDetalladoDeudor(array($anio, $mes));

                //Retorna la tabla deficit
                for($i=0; $i<count($registros); $i++) {
                    $deuda = $registros[$i];
                    $representante = $deuda->getCedula();
                    $idEstudiante = $deuda->getIdEstudiante();
                    $montoInicial = $deuda->getMontoInicial();
                    $montoEstado = $deuda->getMontoEstado();
                    $deficit = $deuda->getDeuda() * -1;

                    //Es el mismo representante?
                    if (strcmp($representanteAux, "") != 0 && (strcmp($representanteAux, $representante) != 0 || $i==count($registros)-1)){
                        //info rep acumulada
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
                    }

                    $estudianteRow = $estudianteRow."
                    <tr>
                        <td>$idEstudiante</td>
                        <td>$montoInicial</td>
                        <td>$montoEstado</td>
                        <td>$deficit</td>
                    </tr>";

                    $representanteAux = $representante;
                    $deudaTotalRep = $deudaTotalRep + $montoInicial;
                    $pagoTotalRep = $pagoTotalRep + $montoEstado;
                    $deficitTotal = $deficitTotal + $deficit;
                }
            }
            catch(Exception $e) {
                echo 'error';
            }
            finally {

            }
        }

        echo $html."</div>";
    }
?>