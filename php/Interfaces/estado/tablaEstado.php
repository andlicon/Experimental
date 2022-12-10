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
        <div>
            <h2>Estado cuenta</h2>
            <table>
                <thead>
                    <tr>
                        <th>Estudiante</th>
                        <th>Días de retraso</th>
                        <th>Monto inicial</th>
                        <th>Monto pagado</th>
                        <th>Monto faltante</th>
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

            $fila = "
                    <tr>
                        <td>$popOver</td>
                        <td>$fechaRetraso</td>
                        <td>$montoInicial</td>
                        <td>$montoEstado</td>
                        <td>$debe</td>
                    </tr>";

            $tabla = $tabla.$fila;

            $deudaTotal += $debe;
        }

        $tabla = $tabla."
                </tbody>
                <tfoot>
                    <tr>
                        <td>Deuda total: $deudaTotal</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        ";

        echo $tabla;
    }

?>