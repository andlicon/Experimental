<?php
    if(isset($_POST['permiso'])) {
        $permiso = $_POST['permiso'];
        $titulo = "Pagos";

        if($permiso==1 || $permiso==3) {
            $titulo =  "Pagos sin confirmar.";
        }

        echo $titulo;
    }
?>