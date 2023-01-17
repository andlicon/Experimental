<?php
    include_once('ConsultarPagoRep.php');
    include_once('ConsultarEstudiante.php');
    include_once('ConsultarDeudaRep.php');
    include_once('ConsultarUsuariosValidez.php');
    include_once('ConsultarPagoAdmin.php');

    echo 'a';
    
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
            else if(str_contains($pagina, "usuarios") && $permiso==4) {
                $consultor = new ConsultarUsuariosValidez();
            }
        }
        else {
            if(str_contains($pagina, "pago") && ($permiso==1 || $permiso==3)) {
                $consultor = new ConsultarPagoRep();
            }
            if(str_contains($pagina, "pago") && ($permiso==4)) {
                echo $_POST['validez'];
                echo $_POST['representante'];
                if(isset($_POST['validez']) && isset($_POST['representante'])) {
                    $validez = $_POST['validez'];
                    $cedula = $_POST['representante'];
                    $consultor = new ConsultarPagoAdmin($validez);
                }
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