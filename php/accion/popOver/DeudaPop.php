<?php
    include_once(POP_PATH.'GenerarPopOver.php');
    include_once(DAO_PATH.'/ClaseConsul.php');
    include_once(DAO_PATH.'/MotivoConsul.php');
    include_once(DAO_PATH.'/EstudianteDAO.php');
    include_once(DAO_PATH.'/BaseDeDatos.php');
    include_once(DTO_PATH.'/Deuda.php');

    class DeudaPop extends GenerarPopOver {
        private $popEstudiante;

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
            $apellidoEstudiante = $resultado[0]->getApellido();
            $idClaseEstudiante = $resultado[0]->getIdClase();
            $cedulaRepEstudiante = $resultado[0]->getCedulaRepresentante();
            $lugarNacimientoEstudiante = $resultado[0]->getLugarNacimiento();
            $fechaEstudiante = $resultado[0]->getFechaNacimiento();

            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
            $claseConsul = new ClaseConsul($bd);
            $claseNombre = null;

            if($idClase!=null) {
                $resultado = $claseConsul->getInstancia(array($idClase));
                $clase = $resultado[0];
                $claseNombre = $clase->getDescripcion();
            }

            $claseNombre = $claseNombre==null ? "Sin asignar" : $claseNombre;

            $popOver = 
            "<div class=\"popOver modificable modificable--estado$id\">
                <a id=\"deuda$id\" href=\"#ex$id\" rel=\"modal:open\" class=\"popOver__trigger\">$deudaId</a>
                <div id=\"ex$id\" class=\"modal\">";
            $popOver = $popOver.
            "       <h4 class=\"popOver__informacion popOver__elemento\">Informacion deuda</h4>
                    <p class=\"popOver__elemento\"><span class=\"negrita\">Cedula:</span> $cedula</p>
                    <p class=\"popOver__elemento\"><span class=\"negrita\">Estudiante:</span> <a id=\"estudiante$id\" href=\"#ex$deudaId$id\" rel=\"modal:open\" class=\"popOver__trigger\">$estudianteNombre</a></p>
                    <p class=\"popOver__elemento\"><span class=\"negrita\">Fecha:</span> $fecha</p>
                    <p class=\"popOver__elemento\"><span class=\"negrita\">Monto Inicial:</span> $montoInicial</p>
                    <p class=\"popOver__elemento\"><span class=\"negrita\">Motivo:</span> $motivo</p>
                </div>

                <div id=\"ex$deudaId$id\" class=\"modal\">
                <h4 class=\"popOver__informacion popOver__elemento\">Informacion Estudiante</h4>
                <p class=\"popOver__elemento\"><span class=\"negrita\">Nombre:</span> $estudianteNombre</p>
                <p class=\"popOver__elemento\"><span class=\"negrita\">Apellido:</span> $apellidoEstudiante</p>
                <p class=\"popOver__elemento\"><span class=\"negrita\">Fecha nacimiento:</span> $fechaEstudiante </p>
                <p class=\"popOver__elemento\"><span class=\"negrita\">Lugar nacimiento:</span> $lugarNacimientoEstudiante</p>
                <p class=\"popOver__elemento\"><span class=\"negrita\">Clase inscrito:</span> $claseNombre</p>
                <p class=\"popOver__elemento\"><span class=\"negrita\">Cédula representante:</span> $cedulaRepEstudiante</p>
            </div>";
            



            return $popOver;
        }
    }

?>