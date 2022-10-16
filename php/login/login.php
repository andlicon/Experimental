<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>

    <link rel="stylesheet" href="/css/main.css">
</head>
<body class="body-login">
    <div class="login">
        <h2 class="login__titulo">Acceda al sistema.</h2>
        <img class="login__imagen" src="#" alt="Logo del colegio">
        <div class="login__boton">
            <div class="boton">

            </div>
        </div>
        <form class="login__formulario formulario" method="POST">
            <div class="formulario__alerta" id="alerta">AAA</div>
            <input class="formulario__input" type="text" placeholder="usuario" name="usuario" required>
            <input class="formulario__input" type="password" placeholder="contraseña" name="contrasena" require>
            <input class="formulario__boton" type="submit" name="login" value="Enviar">
        </form>
    </div>
</body>
</html>

<?php
    include("comprobarLogin.php");
?>