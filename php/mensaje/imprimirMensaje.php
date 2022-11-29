<?php
    include_once('Mensaje.php');

    function imprimirMensaje() {
        if( isset($_GET['mensaje']) ) {
            $serialize = $_GET['mensaje'];
        
            if($serialize) {
                $mensaje = unserialize($serialize);
                echo 
                    '<div class="vista__mensaje" id="mensaje">
                        <button onclick=document.getElementById("mensaje").classList.add("display--oculto")>X</button>'.
                        $mensaje->getKeyInput().' '.$mensaje->getMotivo().' '.$mensaje->getMensaje().
                        '<script type="text/javascript" src="../js/autoEliminar.js"></script>
                    </div>';
            }
        }
    }