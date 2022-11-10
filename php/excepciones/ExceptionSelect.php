<?php
    include_once('../general/Pagina.php');

    class ExceptionSelect extends Exception {
        private Pagina $pagina;

        public function __construct($message, Pagina $pagina, $code = 0, Exception $previous = null) {
            parent::__construct($message, $code, $previous);

            $this->pagina = $pagina;
        }

        public function imprimirError() {
            $this->pagina->imprimirMensaje(null, Mensaje::ERROR, $this->getMessage());
        }
    }
?>