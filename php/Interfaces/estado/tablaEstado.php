<?php
    include_once('../../accion/rutaAcciones.php');
    include_once(DAO_PATH.'BaseDeDatos.php');
    include_once(DAO_PATH.'DeudaDAO.php');
    include_once(DAO_PATH.'EstudianteDAO.php');
    include_once(POP_PATH.'EstudiantePop.php');
    
    if(isset($_POST['cedula'])) {
        $cedula = $_POST['cedula'];

        $tabla = "
        <div class=\"tabla div--seleccionado padding\">
            <h2 class=\"tabla__titulo titulo--bienvenida formu--titulo\">Estado cuenta</h2>
            <table class=\"tabla__table\">
                <thead>
                    <tr class=\"tabla__tr\">
                        <th class=\"tabla__td tabla__th\">Estudiante</th>
                        <th class=\"tabla__td tabla__th\">Días de retraso</th>
                        <th class=\"tabla__td tabla__th\">Monto inicial</th>
                        <th class=\"tabla__td tabla__th\">Monto faltante</th>
                    </tr>
                </thead>
                <tbody>";
                
        $deudaTotal = 0;
        $claseDeuda = "";

        try {
            $deudaDAO = new DeudaDAO(BaseDeDatos::getInstancia());
            $resultado = $deudaDAO->getDeudaGeneralCedula(array($cedula));

            $estudianteDAO = new EstudianteDAO(BaseDeDatos::getInstancia());
            $estudiantePop = new EstudiantePop($estudianteDAO);

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
    
                $claseDeuda = $debe>0 ? "tabla__td--deuda" : "tabla__td--ingresos";
    
                $fila = "
                        <tr class=\"tabla__tr\">
                            <td class=\"tabla__td\" style=\"position:relative;\">$popOver</td>
                            <td class=\"tabla__td\">$fechaRetraso</td>
                            <td class=\"tabla__td tabla__td--deuda\">$montoInicial</td>
                            <td class=\"tabla__td $claseDeuda\">$debe</td>
                        </tr>";
    
                $tabla = $tabla.$fila;
    
                $deudaTotal += $debe;
            }
    
            $claseDeuda = $deudaTotal>0 ? "tabla__td--deuda" : "tabla__td--ingresos";

        }
        catch(Exception $e) {
            /*
            *    Tanto los <tr></tr> de respuesta como posibles errores (como lo es este caso) deberían
            *    ser JSON para así poder manejar mejor el error en JQUERY.
            *    Por cómo está hecho, acá no puedo hacer ningún aviso de error.
            */
        }
        finally {
            $tabla = $tabla."
                </tbody>
                <tfoot>
                    <tr class=\"tabla__tr\">
                        <td colspan=\"3\"></td>
                        <td class=\"tabla__td\">Deuda total: <span class=\"$claseDeuda\">$deudaTotal</span></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        ";
            echo $tabla;
        }
    }

?>