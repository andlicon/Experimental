<?php
    include_once(POP_PATH.'GenerarPopOver.php');

    class RepresentantePop extends GenerarPopOver {

        public function __construct(PersonaDAO $personaDAO) {
            parent::__construct($personaDAO);
        }

        public function generarPop($id) {
            $resultado = $this->consultor->getInstancia(array($id));
            $persona = $resultado[0];
            $cedula = $persona->getCedula();
            $nombre = $persona->getNombre();
            $apellido = $persona->getApellido();

            $popOver = 
            "<div class=\"popOver\">
                <span class=\"popOver__trigger\">$cedula</span>
                <div class=\"popOver__contenido\">";
                    
            $popOver = $popOver.
            "       <span class=\"popOver__informacion\">Informacion</span>
                    <span class=\"popOver__elemento\">$id</span>
                    <span class=\"popOver__elemento\">$nombre</span>
                    <span class=\"popOver__elemento\">$apellido</span>
                </div>
            </div>";


            return $popOver;
        }
    }

?>