<?php
    include_once('CrearBotonMenu.php');
    include_once('CrearBotonPago.php');


    if(isset($_POST['permiso'])) {
        $permiso = $_POST['permiso'];
        $pagina = $_POST['pagina'];

        $creador;

        if(str_contains($pagina, "menu")) {
            $creador = new CrearBotonMenu($permiso);
        }
        else if(str_contains($pagina, "pago")) {
            $creador = new CrearBotonPago($permiso);
        }

        if($creador!=null) {
            echo $creador->crearBotones();
        }
    }
?>