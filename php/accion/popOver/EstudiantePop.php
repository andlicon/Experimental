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
                <input type=\"text\" id=\"estudiante$id\" class=\"popOver__trigger\" value=\"$nombre\" disabled/>
                <div class=\"popOver__contenido\">";
                    
            $popOver = $popOver.
            "       <span class=\"popOver__informacion\">Informacion</span>
                    <span class=\"popOver__elemento\">$nombre</span>
                    <span class=\"popOver__elemento\">$apellido</span>
                    <span class=\"popOver__elemento\">$claseNombre</span>
                </div>
            </div>";


            return $popOver;
        }
    }

?>