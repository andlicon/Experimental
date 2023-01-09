<?php
    interface ICreador {
        public function crearItem($id);
        public function crearItemAtributos($atributos, $id);
    }
?>