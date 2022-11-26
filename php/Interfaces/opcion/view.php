<!DOCTYPE html>
<html lang="en">

<?php
    include_once('../ruta.php');
    include('redireccionarPagina.php');
    include_once(GENERAL_PATH.'deserializarUsuario.php');

    $usuario = deserializarUsuario();
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Opciones</title>

    <link rel="stylesheet" href="/css/main.css">
</head>
<body class="body-page">
    <div class="usuario">

    </div>
    <div class="body-main">
        <h2 class>Opciones</h2>
        <form action="" method="POST" class="vista__form">    
            <!-- botones -->
            <div class="botones">
                <h2 class="botones__titulo">Acciones</h2>
                <?php
                    include_once('getPermiso.php');

                    $permiso = getPermiso($usuario);
                    generarBotones($permiso);
                ?>
            </div>
        </form>
    </div>
</body>
</html>