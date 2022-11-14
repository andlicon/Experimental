<?php
    include_once('../general/Pagina.php');

    $pagina = null;

    if( isset($_POST['gestionar-persona']) ) {
        $pagina = new Pagina(Pagina::PERSONA);
    }
    elseif( isset($_POST['gestionar-contacto']) ) {
        $pagina = new Pagina(Pagina::CONTACTO);
    }
    elseif( isset($_POST['gestionar-pago']) ) {
        $pagina = new Pagina(Pagina::PAGO);
    }
    elseif( isset($_POST['gestionar-deuda']) ) {
        $pagina = new Pagina(Pagina::DEUDA);
    }
    elseif( isset($_POST['gestionar-estudiante']) ) {
        $pagina = new Pagina(Pagina::ESTUDIANTE);
    }
    elseif( isset($_POST['gestionar-profesor']) ) {
        $pagina = new Pagina(Pagina::PROFESOR);
    }
    elseif( isset($_POST['gestionar-clase']) ) {
        $pagina = new Pagina(Pagina::CLASE);
    }
    elseif( isset($_POST['salir']) ) {
        $pagina = new Pagina(Pagina::LOGIN);
    }

    if($pagina!=null) {
        $pagina->actualizarPagina(null);
    }
    
?>