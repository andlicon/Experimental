<?php
    /*
        Interfaz que engloba los distintos contratos referente a la consulta de datos de una base de datos
    */
    interface IConsultor {
        public function getInstancia(array $parametros);
        public function getTodos();
    }
?>