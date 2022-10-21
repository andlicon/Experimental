<?php
    include_once('IModificador.php');

    class RepresentanteModif implements IModificador{
        private BaseDeDatos $bd;

        public function __construct(BaseDeDatos $bd) {
            $this->bd = $bd;
        }

        public function cargar($parametros) {
            $insert = "INSERT INTO representante (cedula_representante)
                       VALUES                    (?)";
            $this->bd->sql($insert, $parametros);
        }
        
    }
?>