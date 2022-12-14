<!DOCTYPE html>
<html lang="en" class="vista">

<?php
    include_once('../ruta.php');
    include_once(GENERAL_PATH.'/getIdClase.php');

    $idClase = getIdClase();

    include_once('evento/consultarEstudiante.php');
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gestionar clase</title>

    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
    <link rel="stylesheet" href="/css/main.css">
</head>
<body class="vista__contenido">
    <?php
        include_once(MENSAJE_PATH.'/imprimirMensaje.php');

        imprimirMensaje();
    ?>
    <h2 class="vista__titulo">Gestionar clase</h2>
    <div class="vista__cuerpo">
        <form action="" method="POST" class="vista__form vista__form--acciones">
            <!-- output seleccionable -->
            <table class="output">
                <colgroup> 
                    <col class="output__col output__col--seleccion">
                    <col class="output__col output__col--nombre">
                    <col class="output__col output__col--apellido">
                    <col class="output__col output__col--fechaNacimiento">
                    <col class="output__col output__col--cedulaRepresentante">
                </colgroup>
                <thead class="output__header">
                    <tr class="output__renglon">
                        <th class="output__celda output__celda--header">
                           Seleccionar 
                        </th>
                        <th class="output__celda output__celda--header">
                           Nombre
                        </th>
                        <th class="output__celda output__celda--header">
                           Apellido 
                        </th>
                        <th class="output__celda output__celda--header">
                           Fecha nacimiento
                        </th>
                        <th class="output__celda output__celda--header">
                           Cedula Representante
                        </th>
                    </tr>
                </thead>
                <tbody class="output__body">
                    <?php
                        include_once(DTO_PATH.'/Estudiante.php');
                        if( isset($_GET['estudiantes']) ) {
                            $serialize = $_GET['estudiantes'];
                        
                            if($serialize) {
                                $estudiantes = unserialize($serialize);
                            
                                for($i=0; $i<count($estudiantes); $i++) {
                                    $estudiante = $estudiantes[$i];
                                    
                                    $idEstudiante = $estudiante->getId();
                                    $nombre = $estudiante->getNombre();
                                    $apellido = $estudiante->getApellido();
                                    $fechaNacimiento = $estudiante->getFechaNacimiento();
                                    $cedulaRepresentante = $estudiante->getCedulaRepresentante();
                                
                                    echo "  <tr class=\"output__renglon\">
                                                <td class=\"output__celda output__celda--centrado\">
                                                    <input type=\"checkbox\" name=\"check[]\" value=\"$idEstudiante,$cedulaRepresentante\" id=\"check$i\">
                                                </td>
                                                <td class=\"output__celda\">
                                                    $nombre
                                                </td>
                                                <td class=\"output__celda\">
                                                    $apellido
                                                </td>
                                                <td class=\"output__celda\">
                                                    $fechaNacimiento
                                                </td>
                                                <td class=\"output__celda\">
                                                    $cedulaRepresentante
                                                </td>
                                            </tr>";
                                }
                            }
                        }
                    ?>
                </tbody>
            </table>
            <!-- botones -->
            <div class="botones">
                <h2 class="botones__titulo">Acciones</h2>
                <button name="citar" class="boton">Citar representante</button>
                <button name="consultar-clase" class="boton">Consultar estudiantes</button>
                <button name="volver" class="boton">volver</button>
            </div>
        </form>
    </div>
</body>
</html>