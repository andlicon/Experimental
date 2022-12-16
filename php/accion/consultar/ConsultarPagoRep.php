<?php
    include_once('Consultor.php');
    include_once('../rutaAcciones.php');
    include_once(DAO_PATH.'BaseDeDatos.php');
    include_once(DAO_PATH.'PagoDAO.php');
    include_once(DAO_PATH.'DeudaDAO.php');
    include_once(DAO_PATH.'CuentaConsul.php');
    include_once(DAO_PATH.'TipoPagoConsul.php');
    include_once(POP_PATH.'DeudaPop.php');

    final class ConsultarPagoRep implements Consultor {
        private $dao;

        public function __construct() {
            $this->dao = new PagoDAO(BaseDeDatos::getInstancia());
        }

        public function consultar(array $cedula) {
            $deudaDAO = new DeudaDAO(BaseDeDatos::getInstancia());
            $deudaPop = new DeudaPop($deudaDAO);
            $cuentaConsul = new CuentaConsul(BaseDeDatos::getInstancia());
            $tipoPagoConsul = new TipoPagoConsul(BaseDeDatos::getInstancia());

            $registros = $this->dao->getInstanciaCedulaValidez($cedula);

            $deudaTotal = 0;
            $html = "";

            for($i=0; $i<count($registros); $i++) {
                $pago = $registros[$i];
                $popDeuda = $deudaPop->generarPop($pago->getIdDeuda());
                
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

                $eliminador = "<input type=\"button\" class=\"eliminar\" id=\"$id\" value=\"eliminar\">";

                //acciones
                $html = $html."
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
                </td>TERMINAACA";
            }

            echo $html;
        }
    }       
?>