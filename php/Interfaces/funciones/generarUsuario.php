<?php
    include_once(GENERAL_PATH.'deserializarUsuario.php');
    include_once(DTO_PATH.'Usuario.php');
    include_once(DAO_PATH.'BaseDeDatos.php');
    include_once(DAO_PATH.'TipoPersonaConsul.php');
    include_once(DAO_PATH.'PersonaDAO.php');
    include_once(GENERADOR_PATH.'boton/GeneradorBotonMenu.php');

    function generarUsuario() {
        if(isset($_POST['usuario'])) {
        $usuario = deserializarUsuario();

        $cedula = $usuario->getCedula();
        $nickname = $usuario->getNickname();
        $valido = $usuario->getValido();

        $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');

        $personaDAO = new PersonaDAO($bd);
        $resultado = $personaDAO->getInstancia(array($cedula));
        $idTipooPersona = $resultado[0]->getIdTipoPersona();

        $tipoPersonaConsul = new TipoPersonaConsul($bd);
        $resultado = $tipoPersonaConsul->getInstancia(array($idTipooPersona));
        $permiso = $resultado[0]->getPermiso();

        echo "
        <script>
            let usuario = {
                cedula : \"$cedula\",
                nickname: \"$nickname\",
                valido: \"$valido\",
                permiso: \"$permiso\"
            };
            localStorage.setItem('usuario', JSON.stringify(usuario));
        </script>";
        }

        echo '<nav class="usuario">
                <div class="usuario__contenido">
                    <div class="usuario__elemento">
                        <img class="usuario__imagen" src="../../../img/interfaz/background/background-s.jpg">
                        <p class="usuario__nickname">
                            <script>
                                let user = localStorage.getItem("usuario");
                                let userObject = JSON.parse(user);
                                let nickname = userObject.nickname;

                                $(".usuario__nickname").html(nickname);
                            </script>';
        echo            '</p>
                    </div>
                    <form action="" method="POST" class="usuario__elemento" id="menu">';
        echo "
                        <script src=\"../js/menu/menu.js\"></script>";
        echo        '</form>
                </div>
            </nav>';
    }
?>