<?php
    include_once('Consultor.php');
    include_once('../rutaAcciones.php');
    include_once(DAO_PATH.'BaseDeDatos.php');
    include_once(DAO_PATH.'PagoDAO.php');
    include_once(DAO_PATH.'DeudaDAO.php');
    include_once(DAO_PATH.'CuentaConsul.php');
    include_once(DAO_PATH.'TipoPagoConsul.php');
    include_once(POP_PATH.'RepresentantePop.php');
    include_once(POP_PATH.'EstudiantePop.php');
    include_once(CREADORES_PATH.'/select/CreadorSelectMotivo.php');

    final class ConsultarDeudaAdmin implements Consultor {
        private $dao;

        public function __construct() {
            $this->dao = new DeudaDAO(BaseDeDatos::getInstancia());
        }

        public function consultar(array $cedula) {
            $registros;
    
            $cedula = $cedula[0];
            $infoAdd = $_POST['infoAdd'];
            $fecha = $_POST['fecha'];
            $motivo = $_POST['motivo'];
        
            if($fecha==null) {
                if(str_contains($cedula, "todos")) {
                    if($motivo!="todos") {
                        if(str_contains($infoAdd, "todas")) {
                            $registros = $this->dao->getInstanciaDeudaTodasMotivo(array($motivo));
                        }
                        else if(str_contains($infoAdd, "saldadas")) {
                            $registros = $this->dao->getInstanciaDeudaSaldadaMotivo(array($motivo));
                        }
                        else {
                            $registros = $this->dao->getInstanciaDeudaVigenteMotivo(array($motivo));
                        }
                    }
                    else {
                        if(str_contains($infoAdd, "todas")) {
                            $registros = $this->dao->getInstanciaDeudaTodas();
                        }
                        else if(str_contains($infoAdd, "saldadas")) {
                            $registros = $this->dao->getInstanciaDeudaSaldada();
                        }
                        else {
                            $registros = $this->dao->getInstanciaDeudaVigente();
                        }
                    }
                }
                else {
                    if($motivo!="todos") {
                        if(str_contains($infoAdd, "todas")) {
                            $registros = $this->dao->getInstanciaDeudaTodasCedulaMotivo(array($cedula, $motivo));
                        }
                        else if(str_contains($infoAdd, "saldadas")) {
                            $registros = $this->dao->getInstanciaDeudaSaldadaCedulaMotivo(array($cedula, $motivo));
                        }
                        else {
                            $registros = $this->dao->getInstanciaDeudaVigenteCedulaMotivo(array($cedula, $motivo));
                        }
                    }
                    else {
                        if(str_contains($infoAdd, "todas")) {
                            $registros = $this->dao->getInstanciaDeudaTodasCedula(array($cedula));
                        }
                        else if(str_contains($infoAdd, "saldadas")) {
                            $registros = $this->dao->getInstanciaDeudaSaldadaCedula(array($cedula));
                        }
                        else {
                            $registros = $this->dao->getInstanciaDeudaVigenteCedula(array($cedula));
                        }
                    }
                }
            }
            else {
                //Fecha
                $fecha = explode("-", $fecha);
                $anio = $fecha[0];
                $mes = $fecha[1];

                if(str_contains($cedula, "todos")) {
                    if($motivo!="todos") {
                        if(str_contains($infoAdd, "todas")) {
                            $registros = $this->dao->getInstanciaDeudaTodasMotivoFecha(array($motivo, $anio, $mes));
                        }
                        else if(str_contains($infoAdd, "saldadas")) {
                            $registros = $this->dao->getInstanciaDeudaSaldadaMotivoFecha(array($motivo, $anio, $mes));
                        }
                        else {
                            $registros = $this->dao->getInstanciaDeudaVigenteMotivoFecha(array($motivo, $anio, $mes));
                        }
                    }
                    else {
                        if(str_contains($infoAdd, "todas")) {
                            $registros = $this->dao->getInstanciaDeudaTodasFecha(array($anio, $mes));
                        }
                        else if(str_contains($infoAdd, "saldadas")) {
                            $registros = $this->dao->getInstanciaDeudaSaldadaFecha(array($anio, $mes));
                        }
                        else {
                            $registros = $this->dao->getInstanciaDeudaVigenteFecha(array($anio, $mes));
                        }
                    }
                }
                else {
                    if($motivo!="todos") {
                        if(str_contains($infoAdd, "todas")) {
                            $registros = $this->dao->getInstanciaDeudaTodasCedulaMotivoFecha(array($cedula, $motivo, $anio, $mes));
                        }
                        else if(str_contains($infoAdd, "saldadas")) {
                            $registros = $this->dao->getInstanciaDeudaSaldadaCedulaMotivoFecha(array($cedula, $motivo, $anio, $mes));
                        }
                        else {
                            $registros = $this->dao->getInstanciaDeudaVigenteCedulaMotivoFecha(array($cedula, $motivo, $anio, $mes));
                        }
                    }
                    else {
                        if(str_contains($infoAdd, "todas")) {
                            $registros = $this->dao->getInstanciaDeudaTodasCedulaFecha(array($cedula, $anio, $mes));
                        }
                        else if(str_contains($infoAdd, "saldadas")) {
                            $registros = $this->dao->getInstanciaDeudaSaldadaCedulaFecha(array($cedula, $anio, $mes));
                        }
                        else {
                            $registros = $this->dao->getInstanciaDeudaVigenteCedulaFecha(array($cedula, $anio, $mes));
                        }
                    }
                }
            }

            $cuentaConsul = new CuentaConsul(BaseDeDatos::getInstancia());
            $tipoPagoConsul = new TipoPagoConsul(BaseDeDatos::getInstancia());
            $motivoConsul = new MotivoConsul(BaseDeDatos::getInstancia());

            $personaDAO = new PersonaDAO(BaseDeDatos::getInstancia());
            $popOverRep = new RepresentantePop($personaDAO);
            $estudianteDAO = new EstudianteDAO(BaseDeDatos::getInstancia());
            $popOverEstu = new EstudiantePop($estudianteDAO);

            $selectMotivo = new CreadorSelectMotivo();

            $deudaTotal = 0;
            $html = "";

            for($i=0; $i<count($registros); $i++) {
                $deuda = $registros[$i];

                $id = $deuda->getId();
                $cedula = $deuda->getCedula();
                $descripcion = $deuda->getDescripcion();
                $fecha = $deuda->getFecha();
                $montoInicial = $deuda->getMontoInicial();
                $montoEstado = $deuda->getMontoEstado();
                $debe = $deuda->getDeuda();
                $idEstudiante = $deuda->getIdEstudiante();
                //motivo
                $idMotivo = $deuda->getIdMotivo();
                $motivo = $motivoConsul->getInstancia(array($idMotivo))[0]->getDescripcion();
                //popOvers
                $popRep = $popOverRep->generarPop($cedula, $cedula);
                $popEstu = $popOverEstu->generarPop($idEstudiante, $idEstudiante);
                //select
                $motivoSelect = $selectMotivo->crearItemAtributosSeleccion("class=\"modificable modificable$id ocultar\"", "motivoInput$id", $idMotivo);

                $eliminador = "<input type=\"button\" class=\"eliminar\" value=\"$id\">";
                $modificador = "<input type=\"button\" class=\"modificar habilitarModif\" value=\"$id\">";
                $aceptar = "<input type=\"button\" class=\"aceptar aceptar$id ocultar\" value=\"$id\">";
                $cancelar = "<input type=\"button\" class=\"cancelar cancelar$id  ocultar\" value=\"$id\">";

                $deudaTotal += $debe;

                $html = $html."
                    <td class=\"output__celda\">
                        $popRep
                    </td>
                    <td class=\"output__celda\">
                        $popEstu
                    </td>
                    <td class=\"output__celda\">
                        <span class=\"modificable modificable--estado$id\">$motivo</span>
                        $motivoSelect
                    </td>
                    <td class=\"output__celda\">
                        <input type=\"text\" id=\"descripcion$id\"class=\"modificable modificable--estado$id\" value=\"$descripcion\" disabled>
                        <input id=\"descripcionInput$id\" type=\"text\" value=\"$descripcion\" disabled class=\"modificable modificable$id ocultar\" onkeypress=\"return soloAlfaNumerico(50, 'descripcionInput$id')\">
                    </td>
                    <td class=\"output__celda\">
                        <input  id=\"fecha$id\" class=\"modificable modificable--estado$id\" value=\"$fecha\" disabled>
                        <input id=\"fechaInput$id\" type=\"date\" value=\"$fecha\" disabled class=\"modificable modificable$id ocultar\">
                    </td>
                    <td class=\"output__celda\">
                        <input type=\"text\" id=\"montoInicial$id\" class=\"modificable modificable--estado$id\" value=\"$montoInicial\" disabled>
                        <input id=\"montoInicialInput$id\" type=\"text\" value=\"$montoInicial\" disabled class=\"modificable modificable$id ocultar\" onkeypress=\"return soloNumeros(8, 'montoInicialInput$id')\">
                    </td>
                    <td class=\"output__celda\">
                        $montoEstado
                    </td>
                    <td class=\"output__celda\">
                        $debe
                    </td>
                    <td class=\"output__celda\">
                        $eliminador
                        $modificador
                        $aceptar
                        $cancelar
                    </td>TERMINAACA";
            }

            $html = $html.="
                $deudaTotal
            ";

            echo $html;
        }

    }       
?>