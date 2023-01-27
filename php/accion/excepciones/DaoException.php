<?php
    class DaoException extends Exception {
        // DAO
        const PERSONA = 1;
        const USUARIO = 2;
        const CONTACTO = 3;
        const ESTUDIANTE = 4;
        const DEUDA = 5;
        const PAGO = 6;
        //  ACCION
        const CARGAR = 'cargar';
        const ELIMINAR = 'eliminar';
        const CONSULTAR = 'consultar';

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