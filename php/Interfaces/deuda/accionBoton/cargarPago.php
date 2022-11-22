<?php
    include_once(GENERAL_PATH.'/Pagina.php');

    if( isset($_POST['cargarPago']) ) {
        $pagina = new Pagina(Pagina::PAGO);

        $pagina->actualizarPagina(null);
    }
?>