<?php
    include_once('CrearBotonMenu.php');


    if(isset($_POST['permiso'])) {
        $permiso = $_POST['permiso'];
        $pagina = $_POST['pagina'];

        $creador;

        if(str_contains($pagina, "menu")) {
            $creador = new CrearBotonMenu($permiso);
        }

        if($creador!=null) {
            echo $creador->crearBotones();
        }
    }
?>