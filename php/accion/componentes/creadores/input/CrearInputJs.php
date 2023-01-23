<?php
    include_once('CreadorInputPago.php');
    include_once('CreadorInputEstudiante.php');
    include_once('CreadorInputDeuda.php');

    
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
        else if(str_contains($pagina, "deuda")) {
            if($permiso==4) {
                $creador = new CreadorInputDeuda($permiso);
            }
        }

        if($creador!=null) {
            echo $creador->crearItemAtributos("", "");
        }
    }
?>