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

    <script src="../js/navegar.js"></script>
    <script src="js/reestablecerPerfil.js"></script>
    <script src="js/reestablecerPerfilAccion.js"></script>
    <script src="js/modificarPerfil.js"></script>
    <script src="../js/limitador/soloNumeros.js"></script>
    <script src="../js/limitador/soloTelefono.js"></script>
    <script src="../js/limitador/soloAlfabeto.js"></script>
    <script src="../js/limitador/soloAlfaNumerico.js"></script>
    <script src="../js/limitador/correo.js"></script>
    <script src="../js/autoEliminar.js"></script>
</head>
<body class="body-page">
    <?php
        include_once('../funciones/generarUsuario.php');
        generarUsuario();
    ?>
    <div class="body-main body-main--perfil">
        <main class="centrado">
            <h2 class="titulo__pagina" style="margin-top:0;">Modificar perfil</h2>
            <?php
                //Realiziar query de persona, usuario y contacto.
            ?>
            <form action="" method="POST" class="bloque perfil">
                <div class="contenido subBloque centrado div--seleccionado" style="border-radius:2em; width:90%; margin:auto;">
                    <h4 class="titulo--bienvenida formu--titulo">
                        datos de persona
                    </h4>
                    <div class="contenido__bloque">
                        <label for="nombre-input" style="color:black;">Nombre</label>
                    </div>
                    <input type="text" class="espaciado" style="border:1px solid black;" id="nombre-input" disabled>
                    <div class="contenido__bloque">
                        <label for="apellido-input" style="color:black;">Apellido</label>
                    </div>
                    <input type="text" class="espaciado" style="border:1px solid black;" id="apellido-input" disabled>
                </div>
                <div class="contenido subBloque centrado div--seleccionado" style="border-radius:2em; width:90%; margin:auto; margin-bottom:1px;">
                    <h3 class="tabla__titulo titulo--bienvenida formu--titulo">
                        datos de contacto
                    </h3>
                    <div class="contenido__bloque">
                        <label for="correo-input" style="color:black;">Correo</label>
                    </div>
                    <input type="text" class="espaciado" style="border:1px solid black;" id="correo-input">
                    <div class="contenido__bloque">
                        <label for="telefono-input" style="color:black;">Telefono</label>
                    </div>
                    <input type="text" class="espaciado" style="border:1px solid black;" id="telefono-input">
                </div>
                <div class="contenido subBloque centrado div--seleccionado" style="border-radius:2em; width:90%; margin:auto;">
                    <h3 class="titulo--bienvenida formu--titulo">
                        datos de usuario
                    </h3>
                    <div class="contenido__bloque">
                        <label for="nickname-input" style="color:black;">Nickname</label>
                    </div>
                    <input type="text" class="espaciado" style="border:1px solid black;" id="nickname-input">
                    <div class="contenido__bloque">
                        <label for="contrasena1-input" style="color:black;">Nueva contraseña</label>
                    </div>
                    <input type="password" class="espaciado" style="border:1px solid black;" id="contrasena1-input">
                    <div class="contenido__bloque">
                        <label for="contrasena2-input" style="color:black;">Repetir contraseña</label>
                    </div>
                    <input type="password" class="espaciado" style="border:1px solid black;" id="contrasena2-input">
                </div>
                <div class="contenidocentrado">
                    <div class="contenido__bloque subBloque--botones">
                        <input type="button" class="boton btn" style="display:flex; flex-flow:column; justify-content:center;" id="enviar" value="Enviar">
                        <input type="button" class="boton btn" style="display:flex; flex-flow:column; justify-content:center;" id="reestablecer" value="Reestablecer">
                    </div>
                </div>
            </form>
        </main>
    </div>
</body>
</html>