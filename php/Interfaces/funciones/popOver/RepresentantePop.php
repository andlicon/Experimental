<?php
    include_once(FUNCIONES_IG_PATH.'popOver/GenerarPopOver.php');

    class RepresentantePop extends GenerarPopOver {

        public function __construct(PersonaDAO $personaDAO) {
            parent::__construct($personaDAO);
        }

        public function generarPop($id, $textoSpan) {
            $resultado = $this->consultor->getInstancia(array($id));
            $persona = $resultado[0];
            $nombre = $persona->getNombre();
            $apellido = $persona->getApellido();

            $popOver = 
            "<div class=\"popOver\">
                <span class=\"popOver__trigger\">$textoSpan</span>
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