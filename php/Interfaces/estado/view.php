<!DOCTYPE html>
<html lang="en" class="vista">
    
<?php
    include_once('../ruta.php');
    // include('../funciones/redireccionarPagina.php');
    // include('tablaCuenta.php');

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Estado cuenta</title>

    <script src="../js/soloMonto.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

    <link rel="stylesheet" href="/css/main.css">

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
    <div class="body-main body-main--estado">
        <h1 class="vista__titulo">
            Estado General
        </h1>
        <div id="tablaCuenta">
            <script src="../js/estado/genTablaCuenta.js"></script>
        </div>
        <div id="tablaEstado">
            <script src="../js/estado/genTablaEstado.js"></script>
        </div>
        <div id="tablaMovimiento">
            <script src="../js/estado/genTablaMovimiento.js"></script>
        </div>
    </div>
</body>
</html>

<script src="../js/navegar.js"></script>