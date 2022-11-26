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
            <form action="" method="POST">
                <?php
                    include_once('getPermiso.php');

                    $permiso = getPermiso($usuario);
                    generarBotones($permiso);
                ?>
            </form>
            </div>
        </div>
    </div>
    <div class="body-main">
        <nav>
            Opciones(Título), volver, opciones de la pagina
        </nav>
        <form action="" method="POST">    
            <!-- botones -->
            <div class="botones">
                <h2 class="botones__titulo">Acciones</h2>
                <button class="boton">
                    <div class="boton__imagen">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                        </svg>
                    </div>
                    <span class="boton__span">
                        hola
                    </span>
                </button>

                <?php
                    include_once('getPermiso.php');

                    $permiso = getPermiso($usuario);
                    //generarBotones($permiso);
                ?>
            </div>
        </form>
    </div>
</body>
</html>