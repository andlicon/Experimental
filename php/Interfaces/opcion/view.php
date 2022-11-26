<!DOCTYPE html>
<html lang="en" class="vista">

<?php
    include_once('../ruta.php');
    include('redireccionarPagina.php');
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Opciones</title>

    <link rel="stylesheet" href="/css/main.css">
</head>
<body class="vista__contenido">
    <h2 class="vista__titulo">Opciones</h2>
    <div class="vista__cuerpo">
        <form action="" method="POST" class="vista__form">    
            <!-- botones -->
            <div class="botones">
                <h2 class="botones__titulo">Acciones</h2>
                <?php
                    include_once(GENERAL_PATH.'deserializarUsuario.php');
                    include_once('getPermiso.php');

                    $usuario = deserializarUsuario();
                    $permiso = getPermiso($usuario);
                    generarBotones($permiso);
                ?>
            </div>
        </form>
    </div>
</body>
</html>