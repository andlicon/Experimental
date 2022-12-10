<?php
    include_once(FUNCIONES_IG_PATH.'popOver/EstudiantePop.php');
    include_once(DAO_PATH.'BaseDeDatos.php');
    include_once(DAO_PATH.'DeudaDAO.php');
    include_once(DAO_PATH.'EstudianteDAO.php');

    function tablaEstado() {
        $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');

        $usuario = deserializarUsuario();
        $cedula = $usuario->getCedula();

                            //C O N S U L T A S
        //Informacion de usuario
        $deudaDAO = new DeudaDAO($bd);
        $resultado = $deudaDAO->getDeudaGeneralCedula(array($cedula));

        //creara popOvers para estudiantes en cada iteracion
        $estudianteDAO = new EstudianteDAO($bd);
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
            $popOver = $estudiantePop->generarPop($idEstudiante);

            $claseDeuda = $debe>0 ? "tabla__td--deuda" : "";

            $fila = "
                    <tr class=\"tabla__tr\">
                        <td class=\"tabla__td\">$popOver</td>
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