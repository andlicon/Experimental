<!DOCTYPE html>
<html lang="en">

<?php
    include_once('../ruta.php');
    include('../funciones/redireccionarPagina.php');
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gestionar usuario</title>

    <link rel="stylesheet" href="/css/main.css">
</head>
<body class="body-page">
    <?php
        include_once('../funciones/generarUsuario.php');
        generarUsuario();
    ?>
    <div class="body-main">
        <nav>
            Opciones(Título), volver, opciones de la pagina
        </nav>
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
                        <label for="nombre-apellido">Apellido</label>
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
                        <label for="contrasena1-input">Nueva contrasena</label>
                        <input type="password" id="contrasena1-input">
                    </div>
                    <div class="contenido__bloque">
                        <label for="contrasena2-input">Repetir contrasena</label>
                        <input type="password" id="contrasena2-input">
                    </div>
                </div>
                <div class="contenido">
                    <div class="contenido__bloque">
                        <button>
                            enviar
                        </button>
                        <button>
                            reestablecer
                        </button>
                    </div>
                </div>
            </form>
        </main>
    </div>
</body>
</html>