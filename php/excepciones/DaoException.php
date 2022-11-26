<?php

    class DaoException extends Exception {
        // CONSTANTES
        const PERSONA = "persona";
        const USUARIO = "usuario";
        const CONTACTO = "contacto";

        private $dao;
        private $accion;

        public function __construct($dao, $accion, $mensaje) {
            parent::__construct($mensaje);
            $this->dao = $dao;
            $this->accion = $accion;
        }

        public function getDao() {
            return $this->dao;
        }

        public function getAccion() {
            return $this->accion;
        }
    }

?>