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
                <input type=\"text\" id=\"cedula$id\" class=\"popOver__trigger\" value=\"$cedula\" disabled>
                <div class=\"popOver__contenido\">";
                    
            $popOver = $popOver.
            "       <span class=\"popOver__informacion\">Informacion</span>
                    <span class=\"popOver__elemento\">$val</span>
                    <span class=\"popOver__elemento\">$nombre</span>
                    <span class=\"popOver__elemento\">$apellido</span>
                </div>
            </div>";


            return $popOver;
        }
    }

?>