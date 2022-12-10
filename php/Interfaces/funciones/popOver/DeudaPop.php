<?php
    include_once(FUNCIONES_IG_PATH.'popOver/GenerarPopOver.php');
    include_once(DAO_PATH.'/ClaseConsul.php');
    include_once(DAO_PATH.'/BaseDeDatos.php');
    include_once(DTO_PATH.'/Deuda.php');

    class DeudaPop extends GenerarPopOver {

        public function __construct(DeudaDAO $deudaeDAO) {
            parent::__construct($deudaeDAO);
        }

        public function generarPop($id) {
            $resultado = $this->consultor->getInstancia(array($id));
            $deuda = $resultado[0];

            $cedula;
            $idEstudiante;
            $fecha;
            $montoInicial;

            //Estudiante
            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
            $estudianteDAO = new EstudianteDAO($bd);
            $resultado = $estudianteDAO->getInstancia(array($idEstudiante));
            $estudianteNombre = $resultado[0]->getNombre();

            $popOver = 
            "<div class=\"popOver\">
                <span class=\"popOver__trigger\">$nombre</span>
                <div class=\"popOver__contenido\">";
                    
            $popOver = $popOver.
            "       <span class=\"popOver__informacion\">Informacion</span>
                    <span class=\"popOver__elemento\">$cedula</span>
                    <span class=\"popOver__elemento\">$estudianteNombre</span>
                    <span class=\"popOver__elemento\">$fecha</span>
                    <span class=\"popOver__elemento\">$montoInicial</span>
                </div>
            </div>";


            return $popOver;
        }
    }

?>