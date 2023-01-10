<?php
    include_once('CreadorInputPago.php');

    
    if(isset($_POST['permiso']) && isset($_POST['pagina'])) {
        $permiso = $_POST['permiso'];
        $pagina = $_POST['pagina'];
        $cedula = $_POST['cedula'];

        $creador;

        if(str_contains($pagina, "pago")) {
            if($permiso==1 || $permiso==3) {
                $creador = new CreadorInputPago($permiso, $cedula);
            }
        }

        if($creador!=null) {
            echo $creador->crearItemAtributos("", "");
        }
    }
?>