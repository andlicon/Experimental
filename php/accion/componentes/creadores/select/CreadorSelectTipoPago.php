<?php
    include_once('../../../rutaAcciones.php');
    include_once('CreadorSelect.php');
    include_once(DAO_PATH.'/TipoPagoConsul.php');

    class CreadorSelectTipoPago extends CreadorSelect {

        public function __construct() {
            parent::__construct(new TipoPagoConsul(new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '')));
        }
        
    } 

?>