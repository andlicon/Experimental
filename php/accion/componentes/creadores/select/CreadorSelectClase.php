<?php
    include_once(__DIR__.'/../../../rutaAcciones.php');
    include_once('CreadorSelect.php');
    include_once(DAO_PATH.'/ClaseConsul.php');
    include_once(DAO_PATH.'/BaseDeDatos.php');

    class CreadorSelectClase extends CreadorSelect {
        
        public function __construct() {
            parent::__construct(new ClaseConsul(new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '')));
        }
    }
?>