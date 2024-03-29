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

    final class ConsultarDeudaRep implements Consultor {
        private $dao;

        public function __construct() {
            $this->dao = new DeudaDAO(BaseDeDatos::getInstancia());
        }

        public function consultar(array $cedula) {
            $registros;
            $fecha = $_POST['fecha'];
            $motivo = $_POST['motivo'];

            if($fecha==null) {
                if($_POST['infoAdd'] != "todos") {
                    if($motivo != "todos") {
                        $registros = $this->dao->getInstanciaEstudianteMotivo(array($_POST['infoAdd'], $motivo));
                    }
                    else {
                        $registros = $this->dao->getInstanciaEstudiante(array($_POST['infoAdd']));
                    }
                }
                else {
                    if($motivo != "todos") {
                        $registros = $this->dao->getInstanciaCedulaMotivo(array($cedula[0], $motivo));
                    }
                    else {
                        $registros = $this->dao->getInstanciaCedula($cedula);
                    }
                }
            }
            else {
                $fecha = explode("-", $fecha);
                $anio = $fecha[0];
                $mes = $fecha[1];
                if($_POST['infoAdd'] != "todos") {
                    if($motivo != "todos") {
                        $registros = $this->dao->getInstanciaEstudianteFechaMotivo(array($_POST['infoAdd'], $anio, $mes, $motivo));
                    }
                    else {
                        $registros = $this->dao->getInstanciaEstudianteFecha(array($_POST['infoAdd'], $anio, $mes));
                    }
                }
                else {
                    if($motivo != "todos") {
                        $registros = $this->dao->getInstanciaCedulaFechaMotivo(array($cedula[0], $anio, $mes, $motivo));
                    }
                    else {
                        $registros = $this->dao->getInstanciaCedulaFecha(array($cedula[0], $anio, $mes));
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

                $deudaTotal += $debe;

                $html = $html."
                    <td class=\"output__celda\">
                        $popRep
                    </td>
                    <td class=\"output__celda\">
                        $popEstu
                    </td>
                    <td class=\"output__celda\">
                        $motivo
                    </td>
                    <td class=\"output__celda\">
                        $descripcion
                    </td>
                    <td class=\"output__celda\">
                        $fecha
                    </td>
                    <td class=\"output__celda\">
                        $montoInicial
                    </td>
                    <td class=\"output__celda\">
                        $montoEstado
                    </td>
                    <td class=\"output__celda\">
                        $debe
                    </td>TERMINAACA";
            }

            $html = $html.="
                $deudaTotal
            ";

            echo $html;
        }

    }       
?>