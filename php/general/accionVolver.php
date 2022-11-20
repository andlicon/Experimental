<?php
    include_once('../general/pagina.php');

    if( isset($_POST['volver']) ) {
        $pagina = new Pagina(Pagina::OPCION);

        $pagina->actualizarPagina(null);
    }
?>