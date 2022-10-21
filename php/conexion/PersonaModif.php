<?php
    include_once ('IModificador.php');

    class PersonaModif implements IModificador {
        private $bd;

        public function __construct(BaseDeDatos $bd) {
            $this->bd = $bd;
        }

        public function cargar($parametros) {
            $insert = "INSERT INTO persona (cedula, nombre, apellido)
                       VALUES              (?,      ?,      ?)";
            $this->bd->sql($insert, $parametros);
        }

    }
?>