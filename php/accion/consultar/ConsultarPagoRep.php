<?php
    include_once('Consultor.php');
    include_once('../rutaAcciones.php');
    include_once(DAO_PATH.'BaseDeDatos.php');
    include_once(DAO_PATH.'PagoDAO.php');
    include_once(DAO_PATH.'DeudaDAO.php');
    include_once(DAO_PATH.'CuentaConsul.php');
    include_once(DAO_PATH.'TipoPagoConsul.php');
    include_once(POP_PATH.'DeudaPop.php');
    include_once(POP_PATH.'RepresentantePop.php');

    final class ConsultarPagoRep implements Consultor {
        private $dao;

        public function __construct() {
            $this->dao = new PagoDAO(BaseDeDatos::getInstancia());
        }

        public function consultar(array $cedula) {
            //daos
            $deudaDAO = new DeudaDAO(BaseDeDatos::getInstancia());
            $cuentaConsul = new CuentaConsul(BaseDeDatos::getInstancia());
            $tipoPagoConsul = new TipoPagoConsul(BaseDeDatos::getInstancia());
            $personaDAO = new PersonaDAO(BaseDeDatos::getInstancia());
            //popOvers
            $popOverRep = new RepresentantePop($personaDAO);
            $deudaPop = new DeudaPop($deudaDAO);

            $registros = $this->dao->getInstanciaCedulaValidez($cedula);

            $deudaTotal = 0;
            $html = "";

            for($i=0; $i<count($registros); $i++) {
                $pago = $registros[$i];
            
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
            
                $popRep = $popOverRep->generarPop($cedula, $id);
                $popDeuda = $deudaPop->generarPop($pago->getIdDeuda(), $id);
            
                $eliminador = "<input type=\"button\" class=\"eliminar\" value=\"$id\">";
                $modificador = "<input type=\"button\" class=\"modificar habilitarModif\" value=\"$id\">";
                $aceptar = "<input type=\"button\" class=\"aceptar aceptar$id ocultar\" value=\"$id\">";
                $cancelar = "<input type=\"button\" class=\"cancelar cancelar$id  ocultar\" value=\"$id\">";
            
                //acciones
                $html = $html."
                <td class=\"output__celda\ output__celda--centrado\">
                    <input type=\"checkbox\" name=\"check[]\" value=\"$id\" 
                        id=\"check$i\" class=\"output__check\">
                </td>
                <td class=\"output__celda\">
                    <span class=\"modificable\">$popDeuda</span>
                </td>
                <td class=\"output__celda\">
                    $popRep
                </td>
                <td class=\"output__celda\">
                    <span  id=\"fecha$id\" class=\"modificable modificable--estado$id\">$fecha</span>
                    <input id=\"fechaInput$id\" type=\"date\" value=\"$fecha\" disabled class=\"modificable modificable$id ocultar\">
                </td>
                <td class=\"output__celda\">
                    <span id=\"monto$id\" class=\"modificable modificable--estado$id\">$monto</span>
                    <input id=\"montoInput$id\" type=\"text\" value=\"$monto\" disabled class=\"modificable modificable$id ocultar\">
                </td>
                <td class=\"output__celda\">
                    <span class=\"modificable\">$cuentaImp </span>
                </td>
                <td class=\"output__celda\">
                    <span class=\"modificable\">$tipoPago</span>
                </td>
                <td class=\"output__celda\">
                    <span id=\"referencia$id\"class=\"modificable modificable--estado$id\">$referencia</span>
                    <input id=\"referenciaInput$id\" type=\"text\" value=\"$referencia\" disabled class=\"modificable modificable$id ocultar\">
                </td>
                <td class=\"output__celda\">
                    <span class=\"modificable\">$estado</span>
                </td>
                <td class=\"output__celda\">
                    $eliminador
                    $modificador
                    $aceptar
                    $cancelar
                </td>TERMINAACA";
            }

            echo $html;
        }
    }       
?>