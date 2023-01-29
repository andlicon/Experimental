<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>

    <link rel="stylesheet" href="/css/main.css">
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="../js/cambiarLamina.js"></script>
    <script src="../js/iniciarSesion.js"></script>
</head>

<?php
    include_once('../ruta.php');
?>

<body class="body-page">
        <?php
            include_once(MENSAJE_PATH.'/imprimirMensaje.php');
            imprimirMensaje();
        ?>

    <!-- LOGIN -->
    <div id="login" class="display--centrado login">
        <h2 class="login__titulo">Unidad Educativa Instituto Experimental.</h2>
        <img class="login__imagen" src="#" alt="Logo del colegio">
        <form class="login__formulario formulario" method="POST">
            <input class="formulario__input" type="text" placeholder="nickname" name="nicknameEntrar" id="nicknameEntrar">
            <input class="formulario__input" type="password" placeholder="contraseña" name="contrasenaEntrar" id="contrasenaEntrar">
            <input class="login__boton" type="submit" id="iniciarSesion" name="login" value="Acceder">
        </form>
        <button class="login__boton" name="crear-usuario" onclick="cambiarVisibilidiad('login', 'registrar');">Crear usuario</button>
    </div>

    <!-- REGISTRAR -->
    <div id="registrar" class="display--centrado display--oculto registrar">
        <h2 class="login__titulo">Registo.</h2>
        <form class="login__formulario formulario" method="POST">
            <!-- persona -->
            <h2>Datos personales</h2>
            <div class="input__grupo">
                <label for="nacionalidadInput" class="input__label">Nacionalidad</label>
                <select name="nacionalidadInput" id="nacionalidadInput" class="input__select">
                   <option value="V-" class="input__select">V-</option>
                    <option value="E-" class="input__select">E-</option>
                </select>
                <label for="cedulaInput" class="input__label">Cedula</label>
                <input type="text" id="cedulaInput" name="cedulaInput" class="input__input input__input--texto" required>
            </div>
            <div class="input__grupo">
                <label for="nombreInput" class="input__label">Nombre</label>
                <input type="text" id="nombreInput" name="nombreInput" class="input__input input__input--texto" required>
            </div>
            <div class="input__grupo">
                <label for="apellidoInput" class="input__label">Apellido</label>
                <input type="text" id="apellidoInput" name="apellidoInput" class="input__input input__input--texto" required>
            </div>
            <!-- contacto -->
            <h2>Datos contacto</h2>
            <div class="input__grupo">
                <label for="correoInput" class="input__label">Correo</label>
                <input type="text" id="correoInput" name="correoInput" class="input__input input__input--texto" required>
            </div>
            <div class="input__grupo">
                <label for="telefonoInput" class="input__label">Telefono</label>
                <input type="text" id="telefonoInput" name="telefonoInput" class="input__input input__input--texto" required>
            </div>
            <!-- usuario -->
            <h2>Datos usuario</h2>
            <div class="input__grupo" id="tipoPersonaInput">
                <script src="../js/consulta/consultarTipoPersona.js"></script>
            </div>
            <div class="input__grupo">
                <label for="nicknameInput" class="input__label">Nickname</label>
               <input type="text" id="nicknameInput" name="nicknameInput" class="input__input input__input--texto" required>
            </div>
            <div class="input__grupo">
               <label for="contrasenaInput" class="input__label">Contraseña</label>
                <input type="password" id="contrasenaInput" name="contrasenaInput" class="input__input input__input--texto" required>
            </div>
            <!-- enviar -->
            <input type="button" class="login__boton boton" id="botonRegistrar" value="Registrar"></button>
        </form>

        <div id="exito" style="display:none">
            Sus datos han sido recibidos con éxito.
        </div>
        <div id="fracaso" style="display:none">
            Se ha producido un error durante el envío de datos.
        </div>
        
        <input class="login__boton" type="submit" name="volver" value="volver" onclick="cambiarVisibilidiad('registrar', 'login');">
    </div>
</body>
</html>

<script src="logear/cargarUsuario.js"></script>
<script src="logear/validarRegistro.js"></script>
