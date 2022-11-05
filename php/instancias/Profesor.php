<?php
    include_once('Persona.php');

    class Profesor extends Persona{
        private Clase $clase;

        public function __construct($cedula, $nombre, $apellido, Contacto $contacto, Clase $clase) {
            parent::__construct($cedula, $nombre, $apellido, $contacto);
            $this->clase = $clase;
        }

        public function getClase() {
            return $this->clase;
        }
        public function setClase(Clase $clase) {
            $this->clase = $clase;
        }
    }

?>