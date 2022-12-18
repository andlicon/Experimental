<?php
    abstract class GenerarPopOver {
        protected $consultor;

        public function __construct(IConsultor $consultor) {
            $this->consultor = $consultor;
        }

        public abstract function generarPop($val, $id);
    }

?>