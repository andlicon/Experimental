<?php
    /*
        Interfaz que une lo contratos referente a:
            * escritura de datos en una base de datos cualquiera
            * Modificacion de datos en una base de datos cualquiera
            * Eliminacion de datos de una base de datos cualquiera
    */
    interface IModificador {
        public function cargar($parametros);
        public function modificar($parametros);
        // public function eliminar($parametros);
    }
?>