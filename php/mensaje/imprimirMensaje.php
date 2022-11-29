<?php
    include_once('Mensaje.php');

    function imprimirMensaje() {
        if( isset($_GET['mensaje']) ) {
            $serialize = $_GET['mensaje'];
        
            if($serialize) {
                $mensaje = unserialize($serialize);
                echo 
                        '<button class="mensaje" id="mensaje" onclick=document.getElementById("mensaje").classList.add("display--oculto")>'.
                        $mensaje->getKeyInput().' '.$mensaje->getMotivo().' '.$mensaje->getMensaje().
                        '</button>'.
                        '<script type="text/javascript" src="../js/autoEliminar.js"></script>';
            }
        }
    }