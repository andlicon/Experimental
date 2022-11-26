<?php

    class DaoException extends Exception {
        // CONSTANTES
        const PERSONA = 1;
        const USUARIO = 2;
        const CONTACTO = 3;
        
        const CARGAR = 'cargar';

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