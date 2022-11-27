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
    </div>
</body>
</html>