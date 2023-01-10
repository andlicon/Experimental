<?php
    include_once('ICreador.php');

    abstract class Creador implements ICreador {
        protected $bd;

        public function __construct($bd) {
            $this->bd = $bd;
        }
    }

    //DE MOMENTO NO ESTÁ EN USO
?>