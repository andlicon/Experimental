<?php
    include_once(GENERAL_PATH.'/pagina.php');

    if( isset($_POST['volver']) ) {
        $pagina = new Pagina(Pagina::OPCION);

        $pagina->actualizarPagina(null);
    }
?>