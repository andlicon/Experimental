<?php
    include_once('CrearBotonMenu.php');
    include_once('CrearBotonPago.php');
    include_once('CrearBotonDeuda.php');
    include_once('CrearBotonEstudiante.php');


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
        else if(str_contains($pagina, "deuda")) {
            $creador = new CrearBotonDeuda($permiso, $_POST['cedula']);
        }
        else if(str_contains($pagina, "estudiante")) {
            $creador = new CrearBotonEstudiante($permiso);
        }

        if($creador!=null) {
            echo $creador->crearBotones();
        }
    }
?>