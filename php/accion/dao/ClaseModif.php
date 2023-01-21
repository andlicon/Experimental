<?php
    include_once ('IModificador.php');
    include_once(DTO_PATH.'/Clase.php');
    include_once(EXCEPTION_PATH.'/DaoException.php');

    class ClaseModif implements IModificador {
        private $bd;

        public function __construct(BaseDeDatos $bd) {
            $this->bd = $bd;
        }

        public function cargar($parametros) {}

        public function modificar($parametros) {
            $update =  "CALL p_modificar_clase(?, ?, ?);";
            $this->bd->sql($update, $parametros);
        }

        public function eliminar($parametros) {}

    }
?>