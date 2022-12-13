<?php
    include_once(TABLA_PATH.'/Tabla.php');
    include_once(DTO_PATH.'/Pago.php');
    include_once(DAO_PATH.'DeudaDAO.php');
    include_once(DAO_PATH.'EstudianteDAO.php');
    include_once(DAO_PATH.'CuentaConsul.php');
    include_once(DAO_PATH.'TipoPagoConsul.php');
    include_once(FUNCIONES_IG_PATH.'popOver/DeudaPop.php');

    class TablaPago extends Tabla {

        public function crearTabla() {

            $tabla = "
            <table class=\"output__table\">
                <colgroup>
                    <col class=\"output__col output__col--seleccion\">
                    <col class=\"output__col output__col--deuda\">
                    <col class=\"output__col output__col--cedula\">
                    <col class=\"output__col output__col--fecha\">
                    <col class=\"output__col output__col--monto\">
                    <col class=\"output__col output__col--cuenta\">
                    <col class=\"output__col output__col--tipoPago\">
                    <col class=\"output__col output__col--referencia\">
                    <col class=\"output__col output__col--estado\">
                    <col class=\"output__col output__col--acciones\">
                </colgroup>
                <thead class=\"output__header\">
                    <tr class=\"output__renglon\">
                        <th class=\"output__celda output__celda--header\">
                           Seleccionar 
                        </th>
                        <th class=\"output__celda output__celda--header\">
                           Referencia deuda
                        </th>
                        <th class=\"output__celda output__celda--header\">
                           Cedula
                        </th>
                        <th class=\"output__celda output__celda--header\">
                           Fecha
                        </th>
                        <th class=\"output__celda output__celda--header\">
                            Monto
                        </th>
                        <th class=\"output__celda output__celda--header\">
                            Cuenta
                        </th>
                        <th class=\"output__celda output__celda--header\">
                            Tipo pago
                        </th>
                        <th class=\"output__celda output__celda--header\">
                            Referencia
                        </th>
                        <th class=\"output__celda output__celda--header\">
                            Estado
                        </th>
                        <th class=\"output__celda output__celda--header\">
                            Acciones
                        </th>
                    </tr>
                </thead>";

            if( isset($_GET['pagos']) ) {
                $serialize = $_GET['pagos'];

                if($serialize) {
                    $pagos = unserialize($serialize);

                    //Conexiones que se utilizaran
                    $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                    $deudaDAO = new DeudaDAO($bd);
                    $deudaPop = new DeudaPop($deudaDAO);
                    $cuentaConsul = new CuentaConsul($bd);
                    $tipoPagoConsul = new TipoPagoConsul($bd);
                    $pagoDAO = new PagoDAO($bd);

                    for($i=0; $i<count($pagos); $i++) {
                        $pago = $pagos[$i];
                        $popDeuda = $deudaPop->generarPop($pago->getIdDeuda());
                        //info
                        $id = $pago->getId();
                        $cedula = $pago->getCedula();
                        $fecha = $pago->getFecha();
                        $monto = $pago->getMonto();
                        $estado = $pago->getValido();
                        $estado = $estado==false ? "por confirmar" : "confirmado";
                        //info cuenta
                        $idCuenta = $pago->getIdCuenta();
                        $resultado = $cuentaConsul->getInstancia(array($idCuenta));
                        $cuenta = $resultado[0]->getDescripcion();
                        $banco = $resultado[0]->getBanco();
                        $cuentaImp = $banco.' '.$cuenta;
                        //tipo pago
                        $resultado = $tipoPagoConsul->getInstancia(array($pago->getIdTipoPago()));
                        $tipoPago = $resultado[0]->getDescripcion();
                        $referencia = $pago->getRef();
                        //acciones
                        $eliminador = "
                                        <input type=\"button\" id=\"$id\" class=\"eliminar\" value=\"Eliminar\">
                                    ";

                        $tabla = $tabla.="
                <tr class=\"output__renglon\">
                    <td class=\"output__celda\ output__celda--centrado\">
                        <input type=\"checkbox\" name=\"check[]\" value=\"$id\" 
                            id=\"check$i\" class=\"output__check\">
                    </td>
                    <td class=\"output__celda\">
                        $popDeuda
                    </td>
                    <td class=\"output__celda\">
                        $cedula
                    </td>
                    <td class=\"output__celda\">
                        $fecha
                    </td>
                    <td class=\"output__celda\">
                        $monto
                    </td>
                    <td class=\"output__celda\">
                        $cuentaImp 
                    </td>
                    <td class=\"output__celda\">
                        $tipoPago
                    </td>
                    <td class=\"output__celda\">
                        $referencia
                    </td>
                    <td class=\"output__celda\">
                        $estado
                    </td>
                    <td class=\"output__celda\">
                        $eliminador
                    </td>
                </tr>";
                    }
                }
            }

            $tabla = $tabla."
            </table>";

            echo $tabla;
        }

    }
?>