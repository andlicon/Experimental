<!DOCTYPE html>
<html lang="en" class="vista">
    
<?php
    include_once('../ruta.php');
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Deuda</title>

    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

    <link rel="stylesheet" href="/css/main.css">

    <script src="../js/eliminar.js"></script>
    <script src="../js/modificar/habilitarModificacion.js"></script>
    <script src="../js/modificar/modificarDeuda.js"></script>
    <script src="../js/modificar/cancelar.js"></script>
    <script src="../js/cargar/cargarDeuda.js"></script>
    <script src="../js/consulta/consultarDeuda.js"></script>
    <script src="../js/navegar.js"></script>
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
    <div class="body-main">
        <h1 class="vista__titulo">
            Deudas Vigentes Detalladas
        </h1>
        <?php
            include_once(MENSAJE_PATH.'/imprimirMensaje.php');
            imprimirMensaje();
        ?>
        <div class="alerta">
            ESTO ES UNA ALERTA
        </div>
        <!-- Display -->
        <form action="" method="POST" class="display">
            <div class="botones">
                <div id="botones">
                    <script src="../js/menu/crearBoton.js"></script>;
                </div>
            </div>
            <div class="output">
                <script>
                    var usuario = JSON.parse(localStorage.getItem('usuario'));
                    var permiso = usuario.permiso;

                    $.ajax ( {
                        url : '../../tabla/TablaDeuda.php',
                        type: 'POST',
                        data : {permiso: permiso},
                        async : false,
                        success : function(response) {
                            $('.output').html(response);
                        }
                    })
                </script>
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