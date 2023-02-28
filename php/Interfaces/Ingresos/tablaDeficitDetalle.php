<?php
    include_once('../../accion/rutaAcciones.php');
    include_once(DAO_PATH.'/BaseDeDatos.php');
    include_once(DAO_PATH.'/DeudaDAO.php');
    include_once(DAO_PATH.'/EstudianteDAO.php');

    if(isset($_POST['fecha'])) {
        $fecha = $_POST['fecha'];
        $html = "<div class=\"tabla\">
                    <h2>Representantes deudores en el cíclo</h2>";
        
        $anio = null;
        $mes = null;

        $deudaDAO = new DeudaDAO(BaseDeDatos::getInstancia());

        $deudores = [];

        try {
            if($fecha!=null) {
                $fecha = explode("-", $fecha);
                $anio = $fecha[0];
                $mes = $fecha[1];
    
                $registros = $deudaDAO->getDeudorFecha(array($anio, $mes));
                for($i=0; $i<count($registros); $i++) {
                    $deudores[] = $registros[$i]->getCedula();
                }
            }
            else {
                $registros = $deudaDAO->getDeudorHistorico();
                $deudores[] = $registros[0]->getCedula();
            }

            if(!empty($deudores)) {
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

                //Por cada representante consultar su deuda por estudiante
                for($i=0; $i<count($deudores); $i++) {
                    //Consultar por estudiante deudor
                    $resultado;

                    if($anio!=null && $mes!=null) {
                        $resultado = $deudaDAO->getDeficitDetalladoDeudor(array($anio, $mes, $deudores[$i]));
                    }
                    else {
                        $resultado = $deudaDAO->getDeficitDetalladoHistoricoDeudor(array($deudores[$i]));
                    }
                    
                    for($j=0; $j<count($resultado); $j++) {
                        $deuda = $resultado[$j];
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
                        $classDeficit = $deficit<0 ? "tabla__td--deuda" : "tabla__td--ingresos";
                        $estudianteRow = $estudianteRow."
                        <tr>
                            <td>$estudiante</td>
                            <td class=\"tabla__td--deuda\">$montoInicial</td>
                            <td class=\"tabla__td--ingresos\">$montoEstado</td>
                            <td class=\"tabla__td--deuda\">$deficit</td>
                        </tr>";

                        $deudaTotalRep = $deudaTotalRep + $montoInicial;
                        $pagoTotalRep = $pagoTotalRep + $montoEstado;
                        $deficitTotal = $pagoTotalRep - $deudaTotalRep;

                        $representanteAux = $representanteAux=="" ? $representante : $representanteAux;

                        $classDeficit = $deficitTotal<0 ? "tabla__td--deuda" : "tabla__td--ingresos";
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
                                                <td class=\"tabla__td--deuda\">$deudaTotalRep</td>
                                                <td class=\"tabla__td--ingresos\">$pagoTotalRep</td>
                                                <td class=\"$classDeficit\">$deficitTotal</td>
                                            </tr>
                                        </tfoot>
                                    </table>";

                        //Ya no tiene sentido que lo haga por estudiante, de hecho deberia arreglar la consulta de arriba
                        //y así ya tendría la información de las consultas que tal

                    }

                    $html = $html.$tablaAux;


                }

            }
        }
        catch(Exception $e) {
           
        }

        echo $html."</div>";
    }
?>