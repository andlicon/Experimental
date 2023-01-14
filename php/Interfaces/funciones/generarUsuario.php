<?php
    function generarUsuario() {
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