<?php 
     include_once ('IModificador.php');

     class ContactoModif implements IModificador {
        private BaseDeDatos $bd;

        public function __construct(BaseDeDatos $bd) {
            $this->bd = $bd;
        }

        public function cargar($parametros) {
            $insert = "INSERT INTO contacto (cedula, id_tipo, contacto)
                       VALUES               (?,      ?,       ?)";
            $this->bd->sql($insert, $parametros);
        }
        
    }
?>