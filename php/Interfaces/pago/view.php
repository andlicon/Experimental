<!DOCTYPE html>
<html lang="en" class="vista">
    
<?php
    include_once('../ruta.php');
    // include_once('eventos/consultar-rep.php');
    // include_once('eventos/consultar.php');
    // include_once('eventos/validar.php');
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pagos</title>

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
    <div class="body-main">
        <h1 class="vista__titulo">
            <script src="TituloPago.js"></script>
        </h1>
        <!-- Display -->
        <form action="" method="POST" class="display">
            <div class="output">
                <?php
                    include_once(TABLA_PATH.'/TablaPago.php');
                    $tabla = new TablaPago();
                    $tabla->crearTabla();
                ?>
            </div>
            <div class="botones">
                <div id="botones">
                    <script src="../js/menu/crearBoton.js"></script>;
                </div>
            </div>

            <div class="input">
                <div id="input">
                    <script src="../js/menu/crearInput.js"></script>;
                </div>
            </div>
        </form>
    </div>
</body>
</html>


<script src="../js/eliminar.js"></script>
<script src="../js/modificar/habilitarModificacion.js"></script>
<script src="../js/modificar/modificarPago.js"></script>
<script src="../js/modificar/cancelar.js"></script>
<script src="../js/cargar/cargarPago.js"></script>
<script src="../js/consulta/consultar.js"></script>