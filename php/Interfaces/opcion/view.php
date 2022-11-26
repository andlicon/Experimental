<!DOCTYPE html>
<html lang="en">

<?php
    include_once('../ruta.php');
    include('redireccionarPagina.php');
    include_once(GENERAL_PATH.'deserializarUsuario.php');
    include_once(DTO_PATH.'Usuario.php');

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
        <div class="usuario__contenido">
            <div class="usuario__elemento">
                <img class="usuario__imagen" src="../../../img/interfaz/background/background-s.jpg">
                <p class="usuario__nickname">
                    <?php
                        $nickname = $usuario->getNickname();
                        echo $nickname;    
                    ?>
                </p>
            </div>
            <form action="" method="POST" class="usuario__elemento">
                <?php
                    include_once('getPermiso.php');
                    $permiso = getPermiso($usuario);
                    generarBotones($permiso);
                ?>
            </form>
        </div>
    </div>
    <div class="body-main">
        <nav>
            Opciones(Título), volver, opciones de la pagina
        </nav>
    </div>
</body>
</html>