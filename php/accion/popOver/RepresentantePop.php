<?php
    include_once(POP_PATH.'GenerarPopOver.php');

    class RepresentantePop extends GenerarPopOver {

        public function __construct(PersonaDAO $personaDAO) {
            parent::__construct($personaDAO);
        }

        public function generarPop($val, $id) {
            $resultado = $this->consultor->getInstancia(array($val));
            $persona = $resultado[0];
            $cedula = $persona->getCedula();
            $nombre = $persona->getNombre();
            $apellido = $persona->getApellido();

            $popOver = 
            "<div class=\"popOver modificable modificable--estado$id\">
                <a id=\"$cedula\" href=\"#ex$cedula\" class=\"popOver__trigger\">$cedula</a>
                <div id=\"ex$cedula\" class=\"modal\">";
                    
            $popOver = $popOver.
            "       <h4 class=\"popOver__informacion popOver__elemento\">Informacion Representante</h4>
                    <p class=\"popOver__elemento\"><span class=\"negrita\">Cedula:</span> $val</p>
                    <p class=\"popOver__elemento\"><span class=\"negrita\">Nombre:</span> $nombre</p>
                    <p class=\"popOver__elemento\"><span class=\"negrita\">Apellido:</span> $apellido</p>
                </div>
            </div>";


            return $popOver;
        }
    }

?>