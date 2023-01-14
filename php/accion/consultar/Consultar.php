<?php
    include_once('ConsultarPagoRep.php');
    include_once('ConsultarEstudiante.php');
    include_once('ConsultarDeudaRep.php');

    if(isset($_POST['pagina']) && isset($_POST['cedula']) && 
       isset($_POST['permiso'])) {
        $pagina = $_POST['pagina'];
        $cedula = $_POST['cedula'];
        $permiso = $_POST['permiso'];

        $consultor = null;

        if(isset($_POST['infoAdd'])) {
            $infoAdd = $_POST['infoAdd'];
            
            if(str_contains($pagina, "deuda") && ($permiso==1 || $permiso==3)) {
                $consultor = new ConsultarDeudaRep();
            }
        }
        else {
            if(str_contains($pagina, "pago") && ($permiso==1 || $permiso==3)) {
                $consultor = new ConsultarPagoRep();
            }
            else if(str_contains($pagina, "estudiante") && ($permiso==1 || $permiso==3)) {
                $consultor = new ConsultarEstudiante();
            }
        }

        if($consultor!=null) {
            echo $consultor->consultar(array($cedula));
        }
    }
?>