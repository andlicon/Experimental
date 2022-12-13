<?php
    include_once(GENERAL_PATH.'deserializarUsuario.php');
    include_once(DTO_PATH.'Usuario.php');
    include_once(GENERADOR_PATH.'boton/GeneradorBotonMenu.php');

    function generarUsuario() {
        $usuario = deserializarUsuario();

        $cedula = $usuario->getCedula();
        $nickname = $usuario->getNickname();
        $valido = $usuario->getValido();

        echo "
        <script>
            const usuario = {
                cedula : \"$cedula\",
                nickname: \"$nickname\",
                valido: \"$valido\"
            };
            localStorage.setItem('usuario', JSON.stringify(usuario));
        </script>";

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
                            $genMenu = new GeneradorBotonMenu($permiso);
                            $genMenu->generarItems();
        echo        '</form>
                </div>
            </nav>';
    }
?>