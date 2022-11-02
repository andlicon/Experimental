<?php
    include_once('../acciones/consultarClase.php');
    /*
        Consulta estudiantes dependiendo de la clase.
    */
    if( isset($_POST['consultar-clase']) ) {
        $pagina = "Location: estudianteView.php";
        
        $idClase = $_POST['claseInput'];
        consultarClase($pagina, $idClase, $pagina, $idClase);
    }
?>