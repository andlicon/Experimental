<?php
    include_once('../general/Pagina.php');
    include_once('ImprimibleException.php');

    class SelectException extends ImprimibleException {
        public function __construct($mensaje, Pagina $pagina) {
            parent::__construct($pagina, $mensaje);

            $this->pagina = $pagina;
        }
    }
?>