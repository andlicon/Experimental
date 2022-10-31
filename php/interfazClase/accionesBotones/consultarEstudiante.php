<?php
    include_once('../acciones/consultarClase.php');

    /*
        Consulta estudiantes dependiendo de la clase.
    */
    if( isset($_POST['consultar-clase']) ) {
        //DEBO ENVIAR SIEMPRE EL $IDCLASE POR URL
        $pagina = "Location: claseView.php?idClase=$idClase";

        consultarClase($pagina, $idClase);
    }
?>