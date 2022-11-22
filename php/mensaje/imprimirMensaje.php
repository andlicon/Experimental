<?php
    include_once('Mensaje.php');

    function imprimirMensaje() {
        if( isset($_GET['mensaje']) ) {
            $serialize = $_GET['mensaje'];
        
            if($serialize) {
                $mensaje = unserialize($serialize);
                echo 
                    '<div class="vista__mensaje" name="hola">'.
                        $mensaje->getKeyInput().' '.$mensaje->getMotivo().' '.$mensaje->getMensaje().
                    '</div>';
            }
        }
    }
?>