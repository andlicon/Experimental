<?php
    include_once(POP_PATH.'GenerarPopOver.php');
    include_once(DAO_PATH.'/ClaseConsul.php');
    include_once(DAO_PATH.'/MotivoConsul.php');
    include_once(DAO_PATH.'/BaseDeDatos.php');
    include_once(DTO_PATH.'/Deuda.php');

    class DeudaPop extends GenerarPopOver {

        public function __construct(DeudaDAO $deudaeDAO) {
            parent::__construct($deudaeDAO);
        }

        public function generarPop($val, $id) {
            $resultado = $this->consultor->getInstancia(array($val));
            $deuda = $resultado[0];

            $deudaId = $deuda->getId();
            $cedula = $deuda->getCedula();
            $idEstudiante = $deuda->getIdEstudiante();
            $fecha = $deuda->getFecha();
            $montoInicial = $deuda->getMontoInicial();
            $idMotivo = $deuda->getidMotivo();

            //Motivo
            $motivoConsul = new MotivoConsul(BaseDeDatos::getInstancia());
            $resultado = $motivoConsul->getInstancia(array($idMotivo));
            $motivo = $resultado[0]->getDescripcion();

            //Estudiante
            $estudianteDAO = new EstudianteDAO(BaseDeDatos::getInstancia());
            $resultado = $estudianteDAO->getInstancia(array($idEstudiante));
            $estudianteNombre = $resultado[0]->getNombre();

            $popOver = 
            "<div class=\"popOver\">
                <span id=\"deuda$id\" class=\"popOver__trigger\">$deudaId</span>
                <div class=\"popOver__contenido\">";
                    
            $popOver = $popOver.
            "       <span class=\"popOver__informacion\">Informacion</span>
                    <span class=\"popOver__elemento\">Cedula: $cedula</span>
                    <span class=\"popOver__elemento\">Estudiante: $estudianteNombre</span>
                    <span class=\"popOver__elemento\">Fecha: $fecha</span>
                    <span class=\"popOver__elemento\">Monto inicial: $montoInicial</span>
                    <span class=\"popOver__elemento\">Motivo: $motivo</span>
                </div>
            </div>";


            return $popOver;
        }
    }

?>