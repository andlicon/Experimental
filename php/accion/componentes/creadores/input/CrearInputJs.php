<?php
    include_once('CreadorInputPago.php');
    include_once('CreadorInputEstudiante.php');

    
    if(isset($_POST['permiso']) && isset($_POST['pagina'])) {
        $permiso = $_POST['permiso'];
        $pagina = $_POST['pagina'];
        $cedula = $_POST['cedula'];

        $creador = null;

        if(str_contains($pagina, "pago")) {
            if($permiso==1 || $permiso==3) {
                $creador = new CreadorInputPago($permiso, $cedula);
            }
        }
        else if(str_contains($pagina, "estudiante")) {
            if($permiso==1 || $permiso==3) {
                $creador = new CreadorInputEstudiante($permiso, $cedula);
            }
        }

        if($creador!=null) {
            echo $creador->crearItemAtributos("", "");
        }
    }
?>