<?php
    include_once('../excepciones/ExceptionSelect.php');
    include_once('../formulario/Mensaje.php');
    include_once('../general/mandarMensaje.php');

    class ExceptionSelect extends Exception {
        private $pagina;

        public function __construct($message, $pagina, $code = 0, Exception $previous = null) {
            parent::__construct($message, $code, $previous);

            $this->pagina = $pagina;
        }

        public function imprimirError() {
            $mensaje = new Mensaje("check[]", false, $this->getMessage());
            mandarMensaje($mensaje, $this->pagina);
        }
    }
?>