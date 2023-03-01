<?php
    include_once('../../accion/rutaAcciones.php');
    include_once(DAO_PATH.'/BaseDeDatos.php');
    include_once(DAO_PATH.'/DeudaDAO.php');

    if(isset($_POST['fecha'])) {
        $fecha = $_POST['fecha'];
        $titulo = "";
        $body = "";

        $deudaGenerada = 0;
        $ingresos = 0;
        $deficit = 0;

        try{
            $registros = null;
            $titulo = "";
            $mes = 0;
            $anio = 0;
            $deudaDAO = new DeudaDAO(BaseDeDatos::getInstancia());

            if($fecha!=null) {
                //Separa la info del front
                $fecha = explode("-", $fecha);
                $anio = $fecha[0];
                $mes = $fecha[1];
                $titulo = "Año: $anio Mes: $mes";
                //consulta
                $registros = $deudaDAO->getDeficit(array($anio, $mes));
            }
            else {
                //Consulta historico
                $titulo = "Histórico";
                $registros = $deudaDAO->getDeficitHistorico();
            }

            $deudaGenerada = 0;
            $ingresos = 0;
            $deficit = 0;
            $anio = "";
            $mes = "";

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
            $classDeficit = $deficit<0 ? "tabla__td--deuda" : "tabla__td--ingresos";
            $body = $body."
                <tr>
                    <h2 class=\"tabla__titulo titulo--bienvenida formu--titulo\">$titulo</td>
                    <td class=\"tabla__td--deuda\">$deudaGenerada</td>
                    <td class=\"tabla__td--ingresos\">$ingresos</td>
                    <td class=\"$classDeficit\">$deficit</td>
                </tr>
            ";
        }
        
        $tabla = "
                <div class=\"tabla\">
                    <h2 class=\"tabla__titulo\" id=\"titulo__deficit\">Déficit del cíclo $titulo</h2>
                    <table class=\"tabla__table\">
                    <thead>
                        <tr class=\"tabla__tr\">
                            <th class=\"tabla__td tabla__th\">Cíclo</th>
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