<?php
    include_once(ROOT_PATH.'/general/Pagina.php');

    abstract class ImprimibleException extends Exception {
        private Pagina $pagina;

        public function __construct(Pagina $pagina, $mensaje, $code = 0, Exception $previous = null) {
            parent::__construct($mensaje, $code, $previous);

            $this->pagina = $pagina;
        }

        public function imprimirError() {
            $this->pagina->imprimirMensaje(null, Mensaje::ERROR, $this->getMessage());
        }
    }
?>