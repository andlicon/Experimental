<?php
    include_once('rutaAcciones.php');

    if(isset($_POST['pagina'])) {
        $pagina = $_POST['pagina'];
        $redireccion = "";

        if(str_contains($pagina, "clase")) {
            $redireccion = "../clase/view.php";
        }
        else if(str_contains($pagina, "deuda")) {
            $redireccion = "../deuda/view.php";
        }
        else if(str_contains($pagina, "estado")) {
            $redireccion = "../estado/view.php";
        }
        else if(str_contains($pagina, "estudiante")) {
            $redireccion = "../estudiante/view.php";
        }
        else if(str_contains($pagina, "login")) {
            $redireccion = "../login/view.php";
        }
        else if(str_contains($pagina, "pago")) {
            $redireccion = "../pago/view.php";
        }
        else if(str_contains($pagina, "perfil")) {
            $redireccion = "../perfil/view.php";
        }
        else if(str_contains($pagina, "profesor")) {
            $redireccion = "../profesor/view.php";
        }
        else if(str_contains($pagina, "estudiante")) {
            $redireccion = "../estudiante/view.php";
        }
        else if(str_contains($pagina, "inicio")) {
            $redireccion = "../inicio/view.php";
        }
        else if(str_contains($pagina, "usuarios")) {
            $redireccion = "../usuarios/view.php";
        }
        else if(str_contains($pagina, "ingresos")) {
            $redireccion = "../ingresos/view.php";
        }
        else {
            $redireccion = "../login/view.php";
        }

        echo $redireccion;
    }

?>