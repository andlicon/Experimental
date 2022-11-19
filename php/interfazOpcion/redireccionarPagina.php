<?php
    include_once('../general/Pagina.php');
    include_once('../instancias/usuario.php');

    $pagina = null;
    $usuario = null;

    if(isset($_GET['usuario']) ) {
        $usuario = $_GET['usuario'];
        $usuario = unserialize($usuario);
    }

    if( isset($_POST['gestionar-persona']) ) {
        $pagina = new Pagina(Pagina::PERSONA, $usuario);
    }
    elseif( isset($_POST['gestionar-contacto']) ) {
        $pagina = new Pagina(Pagina::CONTACTO, $usuario);
    }
    elseif( isset($_POST['gestionar-pago']) ) {
        $pagina = new Pagina(Pagina::PAGO, $usuario);
    }
    elseif( isset($_POST['gestionar-deuda']) ) {
        $pagina = new Pagina(Pagina::DEUDA, $usuario);
    }
    elseif( isset($_POST['gestionar-estudiante']) ) {
        $pagina = new Pagina(Pagina::ESTUDIANTE, $usuario);
    } 
    elseif( isset($_POST['gestionar-profesor']) ) {
        $pagina = new Pagina(Pagina::PROFESOR, $usuario);
    }
    elseif( isset($_POST['gestionar-clase']) ) {
        $pagina = new Pagina(Pagina::CLASE, $usuario);
    }
    elseif( isset($_POST['salir']) ) {
        $pagina = new Pagina(Pagina::LOGIN, $usuario);
    }

    if($pagina!=null) {
        $pagina->actualizarPagina(null);
    }
    
?>