<?php
    include_once(FUNCIONES_IG_PATH.'popOver/GenerarPopOver.php');
    include_once(DAO_PATH.'/ClaseConsul.php');
    include_once(DAO_PATH.'/MotivoConsul.php');
    include_once(DAO_PATH.'/BaseDeDatos.php');
    include_once(DTO_PATH.'/Deuda.php');

    class DeudaPop extends GenerarPopOver {

        public function __construct(DeudaDAO $deudaeDAO) {
            parent::__construct($deudaeDAO);
        }

        public function generarPop($id) {
            $resultado = $this->consultor->getInstancia(array($id));
            $deuda = $resultado[0];

            $deudaId = $deuda->getId();
            $cedula = $deuda->getCedula();
            $idEstudiante = $deuda->getIdEstudiante();
            $fecha = $deuda->getFecha();
            $montoInicial = $deuda->getMontoInicial();
            $descripcion = $deuda->getDescripcion();
            $idMotivo = $deuda->getidMotivo();

            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');

            //Motivo
            $motivoConsul = new MotivoConsul($bd);
            $resultado = $motivoConsul->getInstancia(array($idMotivo));
            $motivo = $resultado[0]->getDescripcion();

            $deudaDescripcion = $descripcion==null ? $motivo : $motivo.': '.$descripcion;

            //Estudiante
            $estudianteDAO = new EstudianteDAO($bd);
            $resultado = $estudianteDAO->getInstancia(array($idEstudiante));
            $estudianteNombre = $resultado[0]->getNombre();

            $popOver = 
            "<div class=\"popOver\">
                <span class=\"popOver__trigger\">$deudaId</span>
                <div class=\"popOver__contenido\">";
                    
            $popOver = $popOver.
            "       <span class=\"popOver__informacion\">Informacion</span>
                    <span class=\"popOver__elemento\">Cedula: $cedula</span>
                    <span class=\"popOver__elemento\">Estudiante: $estudianteNombre</span>
                    <span class=\"popOver__elemento\">Fecha: $fecha</span>
                    <span class=\"popOver__elemento\">Monto inicial: $montoInicial</span>
                    <span class=\"popOver__elemento\">$deudaDescripcion</span>
                </div>
            </div>";


            return $popOver;
        }
    }

?>