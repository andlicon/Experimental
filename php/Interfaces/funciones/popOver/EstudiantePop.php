<?php
    include_once(FUNCIONES_IG_PATH.'popOver/GenerarPopOver.php');
    include_once(DAO_PATH.'/ClaseConsul.php');
    include_once(DAO_PATH.'/BaseDeDatos.php');
    include_once(DTO_PATH.'/Estudiante.php');

    class EstudiantePop extends GenerarPopOver {

        public function __construct(EstudianteDAO $estudianteDAO) {
            parent::__construct($estudianteDAO);
        }

        public function generarPop($id) {
            $resultado = $this->consultor->getInstancia(array($id));
            $estudiante = $resultado[0];

            $id = $estudiante->getId();
            $nombre = $estudiante->getNombre();
            $apellido = $estudiante->getApellido();
            $fecha = $estudiante->getFechaNacimiento();
            $idClase = $estudiante->getIdClase();

            //
            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
            $claseConsul = new ClaseConsul($bd);
            $resultado = $claseConsul->getInstancia(array($idClase));
            $clase = $resultado[0];
            $claseNombre = $clase->getDescripcion();


            $popOver = 
            "<div class=\"popOver\">
                <span class=\"popOver__trigger\">$nombre</span>
                <div class=\"popOver__contenido\">";
                    
            $popOver = $popOver.
            "       <span class=\"popOver__informacion\">Informacion</span>
                    <span class=\"popOver__elemento\">$nombre</span>
                    <span class=\"popOver__elemento\">$apellido</span>
                    <span class=\"popOver__elemento\">$fecha</span>
                    <span class=\"popOver__elemento\">$claseNombre</span>
                </div>
            </div>";


            return $popOver;
        }
    }

?>