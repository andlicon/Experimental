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
    include_once(CREADORES_PATH.'/select/CreadorSelectValido.php');

    final class ConsultarPagoAdmin implements Consultor {
        private $dao;
        private $validez;

        public function __construct($validez) {
            $this->dao = new PagoDAO(BaseDeDatos::getInstancia());
            $this->validez = $validez;
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

            $fecha = $_POST['fecha'];
            $cedula = $cedula[0];

            if($fecha==null) {
                if(str_contains($cedula, "todos")) {
                    if(str_contains($this->validez, "todos")) {
                        $registros = $this->dao->getTodos();
                    }
                    else {
                        $registros = $this->dao->getTodosValidez(array($this->validez));
                    }
                }
                else {
                    if(str_contains($this->validez, "todos")) {
                        $registros = $this->dao->getInstanciaCedula(array($cedula));
                    }
                    else {
                        $registros = $this->dao->getInstanciaCedulaValidez(array($cedula, $this->validez));
                    }
                }
            }
            else {
                //fecha
                $fecha = explode("-", $fecha);
                $anio = $fecha[0];
                $mes = $fecha[1];

                if(str_contains($cedula, "todos")) {
                    if(str_contains($this->validez, "todos")) {
                        $registros = $this->dao->getTodosFecha(array($anio, $mes));
                    }
                    else {
                        $registros = $this->dao->getTodosValidezFecha(array($this->validez, $anio, $mes));
                    }
                }
                else {
                    if(str_contains($this->validez, "todos")) {
                        $registros = $this->dao->getInstanciaCedulaFecha(array($cedula, $anio, $mes));
                    }
                    else {
                        $registros = $this->dao->getInstanciaCedulaValidezFecha(array($cedula, $this->validez, $anio, $mes));
                    }
                }
            }

            $selectValido = new CreadorSelectValido();

            $html = "";

            for($i=0; $i<count($registros); $i++) {
                $pago = $registros[$i];
            
                $id = $pago->getId();
                $cedula = $pago->getCedula();
                $fecha = $pago->getFecha();
                $monto = $pago->getMonto();
                $estado = $pago->getValido();
                $idDeuda = $pago->getIdDeuda();
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
                $popDeuda = $deudaPop->generarPop($idDeuda, $id);
            
                $eliminador = "<input type=\"button\" class=\"eliminar\" value=\"$id\">";
                $modificador = "<input type=\"button\" class=\"modificar habilitarModif\" value=\"$id\">";
                $aceptar = "<input type=\"button\" class=\"aceptar aceptar$id ocultar\" value=\"$id\">";
                $cancelar = "<input type=\"button\" class=\"cancelar cancelar$id  ocultar\" value=\"$id\">";

                $validez = $selectValido->crearItemAtributosSeleccion("class=\"modificable modificable$id ocultar\"", "validoInput$id", $estado);
                $estado = $estado==false ? "Por confirmar" : "Confirmado";

                //acciones
                $html = $html."
                <td class=\"output__celda\">
                    <span class=\"modificable\">$popDeuda</span>
                    <span class=\"modificable$id ocultar\">$idDeuda</span>
                </td>
                <td class=\"output__celda\">
                    $popRep
                    <span class=\"modificable$id ocultar\">$cedula</span>
                </td>
                <td class=\"output__celda\">
                    <span class=\"modificable\">$fecha</span>
                </td>
                <td class=\"output__celda\">
                    <span class=\"modificable\">$monto</span>
                </td>
                <td class=\"output__celda\">
                    <span class=\"modificable\">$cuentaImp</span>
                </td>
                <td class=\"output__celda\">
                    <span class=\"modificable\">$tipoPago</span>
                </td>
                <td class=\"output__celda\">
                    <span class=\"modificable\">$referencia</span>
                </td>
                <td class=\"output__celda\">
                    <input type=\"text\" id=\"estadoInput$id\"class=\"modificable modificable--estado$id\" value=\"$estado\" disabled/>
                    $validez
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