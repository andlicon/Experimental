<?php
    include_once('../../accion/rutaAcciones.php');
    include_once(DAO_PATH.'/BaseDeDatos.php');
    include_once(DAO_PATH.'/DeudaDAO.php');

    if(isset($_POST['fecha'])) {
        $fecha = $_POST['fecha'];
        $titulo = "";
        $body = "";

        if($fecha!=null) {
            $deudaGenerada = 0;
            $ingresos = 0;
            $deficit = 0;
            $anio = "";
            $mes = "";

            try {
                //Separa la info del front
                $fecha = explode("-", $fecha);
                $anio = $fecha[0];
                $mes = $fecha[1];
                $titulo = "Año: $anio Mes: $mes";
                //consultar deficit a la base de datos para el mes aca indicado
                $deudaDAO = new DeudaDAO(BaseDeDatos::getInstancia());
                $registros = $deudaDAO->getDeficit(array($anio, $mes));

                //Retorna la tabla deficit
                for($i=0; $i<count($registros); $i++) {
                    $deuda = $registros[$i];
                    $deudaGenerada += $deuda->getMontoInicial();
                    $ingresos += $deuda->getMontoEstado();
                }

                $deficit = $ingresos - $deudaGenerada;
            }
            catch(Exception $e) {
                $body = "";
                $fecha = "";
            }
            finally {
                $body = $body."
                    <tr>
                        <td>Año:$anio - Mes:$mes </td>
                        <td>$deudaGenerada</td>
                        <td>$ingresos</td>
                        <td>$deficit</td>
                    </tr>
                ";
            }
        }

        $tabla = "
                <div class=\"tabla\">
                    <h2 class=\"tabla__titulo\" id=\"titulo__deficit\">Déficit del cíclo $titulo</h2>
                    <table class=\"tabla__table\">
                    <thead>
                        <tr class=\"tabla__tr\">
                            <th class=\"tabla__td tabla__th\">Fecha</th>
                            <th class=\"tabla__td tabla__th\">Deuda generada</th>
                            <th class=\"tabla__td tabla__th\">Monto Pagado</th>
                            <th class=\"tabla__td tabla__th\">Deficit</th>
                        </tr>
                    </thead>
                    <tbody>
                        $body
                    </tbody>";

        echo $tabla;
    }
?>