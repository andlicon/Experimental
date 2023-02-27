<?php
    include_once(POP_PATH.'/GenerarPopOver.php');
    include_once(DAO_PATH.'/ClaseConsul.php');
    include_once(DAO_PATH.'/BaseDeDatos.php');
    include_once(DTO_PATH.'/Estudiante.php');

    class EstudiantePop extends GenerarPopOver {

        public function __construct(EstudianteDAO $estudianteDAO) { 
            parent::__construct($estudianteDAO);
        }

        public function generarPop($val, $id) {
            $resultado = $this->consultor->getInstancia(array($val));
            $estudiante = $resultado[0];

            $id = $estudiante->getId();
            $nombre = $estudiante->getNombre();
            $apellido = $estudiante->getApellido();
            $idClase = $estudiante->getIdClase();
            $cedulaRep = $estudiante->getCedulaRepresentante();
            $lugarNacimiento = $estudiante->getLugarNacimiento();
            $fecha = $estudiante->getFechaNacimiento();

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
                <a id=\"estudiante$id\" href=\"#ex$id\" rel=\"modal:open\" class=\"popOver__trigger\">$nombre</a>
                <div id=\"ex$id\" class=\"modal\">";
                    
            $popOver = $popOver.
            "       <h4 class=\"popOver__informacion popOver__elemento\">Informacion Estudiante</h4>
                    <p class=\"popOver__elemento\"><span class=\"negrita\">Nombre:</span> $nombre</p>
                    <p class=\"popOver__elemento\"><span class=\"negrita\">Apellido:</span> $apellido</p>
                    <p class=\"popOver__elemento\"><span class=\"negrita\">Fecha nacimiento:</span> $fecha</p>
                    <p class=\"popOver__elemento\"><span class=\"negrita\">Lugar nacimiento:</span> $lugarNacimiento</p>
                    <p class=\"popOver__elemento\"><span class=\"negrita\">Clase inscrito:</span> $claseNombre</p>
                </div>
            </div>";


            return $popOver;
        }
    }

?>