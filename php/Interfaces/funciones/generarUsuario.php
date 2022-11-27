<?php
    include_once(GENERAL_PATH.'deserializarUsuario.php');
    include_once(DTO_PATH.'Usuario.php');
    include('generarBotones.php');

    function generarUsuario() {
        $usuario = deserializarUsuario();

        echo '<nav class="usuario">
                <div class="usuario__contenido">
                    <div class="usuario__elemento">
                        <img class="usuario__imagen" src="../../../img/interfaz/background/background-s.jpg">
                        <p class="usuario__nickname">';
                            $nickname = $usuario->getNickname();
                            echo $nickname;
        echo            '</p>
                    </div>
                    <form action="" method="POST" class="usuario__elemento">';
                            include_once('getPermiso.php');
                            $permiso = getPermiso($usuario);
                            generarBotones($permiso);
        echo        '</form>
                </div>
            </nav>';
    }
?>