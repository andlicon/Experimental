<?php
    include_once('ConsultarPagoRep.php');
    include_once('ConsultarEstudiante.php');
    include_once('ConsultarDeudaRep.php');
    include_once('ConsultarUsuariosValidez.php');
    include_once('ConsultarPagoAdmin.php');
    include_once('ConsultarDeudaAdmin.php');
    include_once('ConsultarEstudianteAdmin.php');
    include_once('ConsultarEstudianteSec.php');
    include_once('ConsultarProfesores.php');
    include_once('ConsultarPerfil.php');

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
            else if(str_contains($pagina, "deuda") && $permiso==4) {
                $consultor = new ConsultarDeudaAdmin();
            }
            else if(str_contains($pagina, "usuarios") && ($permiso==4 || $permiso==5)) {
                $consultor = new ConsultarUsuariosValidez($infoAdd);
            }
        }
        else {
            if(str_contains($pagina, "pago") && ($permiso==1 || $permiso==3)) {
                $consultor = new ConsultarPagoRep();
            }
            else if(str_contains($pagina, "pago") && ($permiso==4)) {
                if(isset($_POST['validez']) && isset($_POST['representante'])) {
                    $validez = $_POST['validez'];
                    $cedula = $_POST['representante'];
                    $consultor = new ConsultarPagoAdmin($validez);
                }
            }
            else if(str_contains($pagina, "estudiante") && ($permiso==1 || $permiso==3)) {
                $consultor = new ConsultarEstudiante();
            }
            else if(str_contains($pagina, "estudiante") && $permiso==4) {
                if(isset($_POST['validez']) && isset($_POST['representante']) && isset($_POST['clase'])) {
                    $consultor = new ConsultarEstudianteAdmin();
                }
            }
            else if(str_contains($pagina, "estudiante") && $permiso==5) {
                $consultor = new ConsultarEstudianteSec();
            }
            else if(str_contains($pagina, "profesor") && $permiso==4) {
                $consultor = new ConsultarProfesores();
            }
            else if(str_contains($pagina, "perfil")) {
                $consultor = new ConsultarPerfil();
            }
        }

        if($consultor!=null) {
            echo $consultor->consultar(array($cedula));
        }
    }
?>