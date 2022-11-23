<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>

    <link rel="stylesheet" href="/css/main.css">
    <script type="text/javascript" src="../js/cambiarLamina.js"></script>
</head>

<?php
    include_once('../ruta.php');
    include("comprobarLogin.php");
?>

<body class="body-login">
        <?php
            include_once(MENSAJE_PATH.'/imprimirMensaje.php');
            imprimirMensaje();
        ?>

    <div id="login" class="login__display">
        <h2 class="login__titulo">Unidad Educativa Instituto Experimental.</h2>
        <img class="login__imagen" src="#" alt="Logo del colegio">
        <form class="login__formulario formulario" method="POST">
            <input class="formulario__input" type="text" placeholder="usuario" name="nicknameEntrar">
            <input class="formulario__input" type="password" placeholder="contraseña" name="contrasenaEntrar">
            <input class="login__boton" type="submit" name="login" value="Acceder">
        </form>
        <button class="login__boton" name="crear-usuario" onclick="cambiarVisibilidiad('login', 'registrar');">Crear usuario</button>
    </div>

    <div id="registrar" class="login__display display--oculto">
        <h2 class="login__titulo">Registo.</h2>
        <img class="login__imagen" src="#" alt="Logo del colegio">
        <form class="login__formulario formulario" method="POST">
            <!-- persona -->
            <div class="input__grupo">
                    <label for="nacionalidadInput" class="input__label">Nacionalidad</label>
                    <select name="nacionalidadInput" id="nacionalidadInput" class="input__select">
                        <option value="V-" class="input__select">V-</option>
                        <option value="E-" class="input__select">E-</option>
                    </select>
                    <label for="cedulaInput" class="input__label">Cedula</label>
                    <input type="text" id="cedulaInput" name="cedulaInput" class="input__input input__input--texto">
                </div>
                <div class="input__grupo">
                    <label for="nombreInput" class="input__label">Nombre</label>
                    <input type="text" id="nombreInput" name="nombreInput" class="input__input input__input--texto">
                </div>
                <div class="input__grupo">
                    <label for="apellidoInput" class="input__label">Apellido</label>
                    <input type="text" id="apellidoInput" name="apellidoInput" class="input__input input__input--texto">
                </div>
                <div class="input__grupo">
                    <label for="nicknameInput" class="input__label">Nickname</label>
                    <input type="text" id="nicknameInput" name="nicknameInput" class="input__input input__input--texto">
                </div>
                <div class="input__grupo">
                    <label for="contrasenaInput" class="input__label">Contraseña</label>
                    <input type="password" id="contrasenaInput" name="contrasenaInput" class="input__input input__input--texto">
                </div>
            <input class="login__boton" type="submit" name="registrar" value="Registrar">
        </form>
        <input class="login__boton" type="submit" name="volver" value="volver" onclick="cambiarVisibilidiad('registrar', 'login');">
    </div>
</body>
</html>