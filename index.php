<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>

    <link rel="stylesheet" href="/css/main.css">
</head>

<?php
    include("comprobarLogin.php");
?>

<body class="body-login">
    <div class="login">
        <?php
            include_once('../general/imprimirMensaje.php');

            imprimirMensaje();
        ?>
        <h2 class="login__titulo">Unidad Educativa Instituto Experimental.</h2>
        <img class="login__imagen" src="#" alt="Logo del colegio">
        <form class="login__formulario formulario" method="POST">
            <div class="formulario__alerta" id="alerta"></div>
            <input class="formulario__input" type="text" placeholder="usuario" name="usuario" required>
            <input class="formulario__input" type="password" placeholder="contraseña" name="contrasena" require>
            <input class="login__boton" type="submit" name="login" value="Acceder">
        </form>
    </div>
</body>
</html>