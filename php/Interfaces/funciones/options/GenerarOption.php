<?php
    include_once(DAO_PATH.'IConsultor.php');

    abstract class GenerarOption {
        protected IConsultor $consultor;

        public function __construct(IConsultor $consultor) {
            $this->consultor = $consultor;
        }

        public abstract function generar($name, $text);

    }
?>