<?php
    include_once('../general/Pagina.php');

    if( isset($_POST['cargarPago']) ) {
        $pagina = new Pagina(Pagina::PAGO);

        $pagina->actualizarPagina(null);
    }
?>