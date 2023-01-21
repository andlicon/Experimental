<?php
    include_once(__DIR__.'/../../../rutaAcciones.php');
    include_once(DAO_PATH.'TipoPersonaConsul.php');
    include_once('CreadorSelect.php');

    class CreadorSelectTipoPersona extends CreadorSelect {
        
        public function __construct() {
            parent::__construct(new TipoPersonaConsul(BaseDeDatos::getInstancia()));
        }

    }

?>