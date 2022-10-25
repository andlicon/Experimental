<?php
    include_once('IModificador.php');

    class RepresentanteModif implements IModificador{
        private $bd;
        
        public function __construct($bd) {
            $this->bd = $bd;
        }

        public function cargar($parametros) {
            $insert = "INSERT INTO representante (cedula_representante)
                       VALUES              (?)";
            $this->bd->sql($insert, $parametros);
        }

        public function modificar($parametros) {
            $update =  "UPDATE representante
                        SET cedula_representante=?, 
                        WHERE id=?";
            $this->bd->sql($update, $parametros);
        }

        public function eliminar($parametros) {
            $delete =  "DELETE representante
                        WHERE cedula_representante=?";
            $this->bd->sql($delete, $parametros);
        }
    }
?>