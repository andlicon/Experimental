<?php
    include_once('IModificador.php');
    include_once('IConsultor.php');

    /*
        Interfaz que unifica los distintas contratos, que deben ser imnplementados
        para el acceso a informacion, así como su modificacion.
    */
    interface IDAO extends IModificador, IConsultor {
        
    }
?>