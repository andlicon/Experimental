<?php
    include_once('../../../rutaAcciones.php');
    include_once('CreadorSelect.php');
    include_once(DAO_PATH.'/CuentaConsul.php');

    class CreadorSelectCuenta extends CreadorSelect {
        
        public function __construct() {
            parent::__construct(new CuentaConsul(new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '')));
        }
        
    }
?>