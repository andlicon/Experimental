<?php
    include_once('../../accion/rutaAcciones.php');
    include_once(DAO_PATH.'BaseDeDatos.php');
    include_once(DAO_PATH.'DeudaDAO.php');
    include_once(DAO_PATH.'EstudianteDAO.php');
    include_once(POP_PATH.'EstudiantePop.php');
    
    if(isset($_POST['cedula'])) {
        $cedula = $_POST['cedula'];

        $deudaDAO = new DeudaDAO(BaseDeDatos::getInstancia());
        $resultado = $deudaDAO->getDeudaGeneralCedula(array($cedula));

        $estudianteDAO = new EstudianteDAO(BaseDeDatos::getInstancia());
        $estudiantePop = new EstudiantePop($estudianteDAO);

        $deudaTotal = 0;

        $tabla = "
            <div class=\"tabla\">
                <h2 class=\"tabla__titulo\">Estado cuenta</h2>
                <table class=\"tabla__table\">
                    <thead>
                        <tr class=\"tabla__tr\">
                            <th class=\"tabla__td tabla__th\">Estudiante</th>
                            <th class=\"tabla__td tabla__th\">Días de retraso</th>
                            <th class=\"tabla__td tabla__th\">Monto inicial</th>
                            <th class=\"tabla__td tabla__th\">Monto pagado</th>
                            <th class=\"tabla__td tabla__th\">Monto faltante</th>
                        </tr>
                    </thead>
                    <tbody>";
            for($i=0; $i<count($resultado); $i++) {
            //Info Deuda
            $deuda = $resultado[$i];
            $idEstudiante = $deuda->getIdEstudiante();
            $fechaRetraso = $deuda->getFecha();
            $montoInicial = $deuda->getMontoInicial();
            $montoEstado = $deuda->getMontoEstado();
            $debe = $deuda->getDeuda();

            //InfoEstudiante
            $popOver = $estudiantePop->generarPop($idEstudiante, $i);

            $claseDeuda = $debe>0 ? "tabla__td--deuda" : "";

            $fila = "
                    <tr class=\"tabla__tr\">
                        <td class=\"tabla__td\" style=\"position:relative;\">$popOver</td>
                        <td class=\"tabla__td\">$fechaRetraso</td>
                        <td class=\"tabla__td\">$montoInicial</td>
                        <td class=\"tabla__td\">$montoEstado</td>
                        <td class=\"tabla__td $claseDeuda\">$debe</td>
                    </tr>";

            $tabla = $tabla.$fila;

            $deudaTotal += $debe;
        }

        $claseDeuda = $deudaTotal>0 ? "tabla__td--deuda" : "";

        $tabla = $tabla."
                </tbody>
                <tfoot>
                    <tr class=\"tabla__tr\">
                        <td colspan=\"4\"></td>
                        <td class=\"tabla__td\">Deuda total: <span class=\"$claseDeuda\">$deudaTotal</span></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        ";

        echo $tabla;
    }

?>