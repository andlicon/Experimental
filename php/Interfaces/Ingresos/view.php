<!DOCTYPE html>
<html lang="en" class="vista">
    
<?php
    include_once('../ruta.php');
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Ingresos</title>

    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    
    <link rel="stylesheet" href="/css/main.css">
</head>
<body class="body-page">
    <?php
        include_once('../funciones/generarUsuario.php');
        generarUsuario();
    ?>
    <div class="body-main body-main--estado">
        <h1 class="vista__titulo">
            Ingresos
        </h1>

        <div class="display">
            <div class="botones">
                <div id="botones">
                    <script src="../js/menu/crearBoton.js"></script>;
                </div>
            </div>
        </div>
        <div id="deficit">
            <script src="../js/estado/genTablaDeficit.js"></script>
        </div>
        <div id="deficitDetallado">
            <script src="../js/estado/genTablaDeficitDetallado.js"></script>
        </div>
    </div>
</body>

</html>

<script src="../js/consulta/consultarEstudiante.js"></script>
<script src="../js/navegar.js"></script>