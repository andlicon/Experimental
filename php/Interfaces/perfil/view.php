<!DOCTYPE html>
<html lang="en">

<?php
    include_once('../ruta.php');
    // include('../funciones/redireccionarPagina.php');
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gestionar usuario</title>

    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link rel="stylesheet" href="/css/main.css">
</head>
<body class="body-page">
    <?php
        include_once('../funciones/generarUsuario.php');
        generarUsuario();
    ?>
    <div class="body-main">
        <main>
            <?php
                //Realiziar query de persona, usuario y contacto.
            ?>
            <form action="" method="POST">
                <div class="contenido">
                    <h3 class="contenido__titulo">
                        datos de persona
                    </h3>
                    <div class="contenido__bloque">
                        <label for="nombre-input">Nombre</label>
                        <input type="text" id="nombre-input">
                    </div>
                    <div class="contenido__bloque">
                        <label for="apellido-input">Apellido</label>
                        <input type="text" id="apellido-input">
                    </div>
                </div>
                <div class="contenido">
                    <h3 class="contenido__titulo">
                        datos de contacto
                    </h3>
                    <div class="contenido__bloque">
                        <label for="correo-input">Correo</label>
                        <input type="text" id="correo-input">
                    </div>
                    <div class="contenido__bloque">
                        <label for="telefono-input">Telefono</label>
                        <input type="text" id="telefono-input">
                    </div>
                </div>
                <div class="contenido">
                    <h3 class="contenido__titulo">
                        datos de usuario
                    </h3>
                    <div class="contenido__bloque">
                        <label for="nickname-input">Nickname</label>
                        <input type="text" id="nickname-input">
                    </div>
                    <div class="contenido__bloque">
                        <label for="contrasena1-input">Nueva contraseña</label>
                        <input type="password" id="contrasena1-input">
                    </div>
                    <div class="contenido__bloque">
                        <label for="contrasena2-input">Repetir contraseña</label>
                        <input type="password" id="contrasena2-input">
                    </div>
                </div>
                <div class="contenido">
                    <div class="contenido__bloque">
                        <input type="button" class="boton" id="enviar" value="Enviar">
                        <input type="button" class="boton" id="reestablecer" value="Reestablecer">
                    </div>
                </div>
            </form>
        </main>
    </div>
</body>
</html>
<script src="../js/navegar.js"></script>
<script src="js/reestablecerPerfil.js"></script>
<script src="js/reestablecerPerfilAccion.js"></script>
<script src="js/validarPerfil.js"></script>
<script src="js/modificarPerfil.js"></script>